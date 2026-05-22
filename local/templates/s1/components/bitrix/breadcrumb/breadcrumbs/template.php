<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();


$strReturn .= '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList"><div class="container"><ul class="breadcrumbs__list">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = '<span class="separator">
                    <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.353516 0.353554L3.35352 3.35355L0.353516 6.35355" stroke="#5E5F64" />
                    </svg>
                </span>';

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="breadcrumbs__item" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
					<span itemprop="name">'.$title.'</span>
				</a>
				'.$arrow.'
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="breadcrumbs__item">
				<span>
				<span>'.$title.'</span>
                </span>
			</li>';
	}
}

$strReturn .= '</ul></div></div>';

return $strReturn;

// <div class="breadcrumbs {{page ? 'index' : ''}}">
    
        
//             <li class="breadcrumbs__item">
//                 <a href="/">
//                     <span>Главная</span>
//                 </a>
//                 <span class="separator">
//                     <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg">
//                         <path d="M0.353516 0.353554L3.35352 3.35355L0.353516 6.35355" stroke="#5E5F64" />
//                     </svg>
//                 </span>
//             </li>
//             <li class="breadcrumbs__item">
                
//                     <span>О компании</span>

//             </li>
//         </ul>
//     </div>
// </div>
