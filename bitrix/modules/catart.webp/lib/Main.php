<?
namespace CatArt\Webp;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use ImageConverter;

class Main {

    public static function webpGenerate(&$content = null) {
        if (defined('ADMIN_SECTION')) {
            if (ADMIN_SECTION === true) {
                return false;
            }
        }

        $module_id = pathinfo(dirname(__DIR__))['basename'];

        if ($content == null) {
                return false;
        }

        if (Option::get($module_id, 'switch_on') != 'Y') {
                return false;
        }

        /* if (!file_exists(dirname(__DIR__) . '/lib/imageconverter.php')) {
                trigger_error('Failed load class: ImageConverter', E_USER_WARNING);

                return false;
        }

        if (!file_exists(dirname(__DIR__) . '/lib/simple_html_dom.php')) {
            trigger_error('Failed load class: DomParser', E_USER_WARNING);

            return false;
        } */

        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false or strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/') !== false) {
                $rootPath = rtrim(Application::getDocumentRoot(), '/');

                $imgQuality = (int)(Option::get($module_id, 'quality') ? Option::get($module_id, 'quality') : 100);
                $imgQuality = abs($imgQuality);
                $imgQuality = ($imgQuality > 100) ? 100 : $imgQuality;

                $imgFolder = (string)(Option::get($module_id, 'folder') ? Option::get($module_id, 'folder') : '/upload/webp/');
                $imgFolder = $imgFolder . '/' . $imgQuality . '/';
                $imgFolder = str_replace('//', '/', $imgFolder);
                $rootFolderPath = $rootPath . $imgFolder;

                $imageExtExclude = explode(',', (string)(Option::get($module_id, 'ext_exclude') ? Option::get($module_id, 'ext_exclude') : '.svg,.webp,.php,https://,http://'));

                if (!file_exists($rootFolderPath)) {
                    mkdir($rootFolderPath, 0777, true);
                }

                $imagesLinks = [];

                include_once dirname(__DIR__) . '/lib/imageconverter.php';
                include_once dirname(__DIR__) . '/lib/simple_html_dom.php';

                $ImageConverter = new ImageConverter();

                $output = str_get_html($content);

                if (!$output) {
                    return false;
                }

                $images = $output->find('img');

                $imgDataSrc = Option::get($module_id, 'data_src');

                foreach ($images as $image) {
                    if ($image->hasAttribute('src')) {
                        $imagesLinks[] = trim($image->getAttribute('src'));
                    } else if (Option::get($module_id, 'data_src') == 'Y' && $image->hasAttribute('data-src')) {
                        $imageLinks = explode(',', $image->getAttribute('data-src'));

                        foreach ($imageLinks as $link) {
                            $imagesLinks[] = explode(' ', trim($link))[0];
                        }
                    } else if (Option::get($module_id, 'srcset') == 'Y' && $image->hasAttribute('srcset')) {
                        $imageLinks = explode(',', $image->getAttribute('srcset'));

                        foreach ($imageLinks as $link) {
                            $imagesLinks[] = explode(' ', trim($link))[0];
                        }
                    } else if (Option::get($module_id, 'data_srcset') == 'Y' && $image->hasAttribute('data-srcset')) {
                        $imageLinks = explode(',', $image->getAttribute('data-srcset'));

                        foreach ($imageLinks as $link) {
                            $imagesLinks[] = explode(' ', trim($link))[0];
                        }
                    }
                }

                $imgStyle = Option::get($module_id, 'style');

                if ($imgStyle != 'N') {
                    $styles = $output->find('[style]');

                    foreach ($styles as $style) {
                        preg_match('/(?<=url\().+(?=\))/', $style->getAttribute('style'), $styleMatch);

                        if ($styleMatch[0]) {
                            $imagesLinks[] = str_replace('"', '', (str_replace("'", "", $styleMatch[0])));
                        }
                    }
                }

                $imagesLinks = array_unique($imagesLinks);
                $imagesLinks = array_diff($imagesLinks, ['']);

                foreach ($imagesLinks as $image) {
                    foreach ($imageExtExclude as $extExclude) {
                        if (strrpos((string)$image, (string)$extExclude) !== false) {
                            continue 2;
                        }
                    }

                    if ($image[0] != '/') {
                        $rootImage = $rootPath . '/' . $image;
                    } else {
                        $rootImage = $rootPath . $image;
                    }

                    $imageInfo = pathinfo($rootImage);

                    $imageName = $imageInfo['filename'];
                    $imageName = str_replace(
                        [
                            '_',
                            '.'
                        ],
                        [
                            '-',
                            '-'
                        ],
                        $imageName
                    );

                    $imagePath = explode('/', $image);
                    unset($imagePath[count($imagePath) - 1]);
                    $imagePath = implode('/', $imagePath);
                    $imagePath = ltrim($imagePath, '/');
                    $imagePath = rtrim($imagePath, '/');
                    $imagePath = str_replace(
                        [
                            '_',
                            '.'
                        ],
                        [
                            '-',
                            '-'
                        ],
                        $imagePath
                    );
                    $rootImagePath = $rootFolderPath . $imagePath . '/';

                    if (file_exists($rootPath . $image) && !file_exists($rootImagePath . $imageName . '.webp')) {
                        if (!file_exists($rootImagePath)) {
                            mkdir($rootImagePath, 0777, true);
                        }

                        try {
                            $ImageConverter->convert($rootImage, $rootImagePath . $imageName . '.webp', $imgQuality);
                            $content = str_replace($image, $imgFolder . $imagePath . '/'  . $imageName . '.webp', $content);
                        } catch (Exception $e) {
                            trigger_error($e, E_USER_WARNING);
                            continue;
                        }
                    } else {
                        $content = str_replace($image, $imgFolder . $imagePath . '/' . $imageName . '.webp', $content);
                    }
                }
        }

        return $content;
    }

}
?>