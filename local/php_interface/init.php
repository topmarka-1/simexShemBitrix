<?
use Bitrix\Main\Loader;
$isMainPage = $APPLICATION->GetCurPage(false) == '/';
function printR($array)
{
	echo '<pre style="width:100%;height:400px;overflow:auto;">' . print_r($array, true) . '</pre>';
}

AddEventHandler(
    'form',
    'onAfterResultAdd',
    'addEmailToSubscription'
);

function addEmailToSubscription($WEB_FORM_ID, $RESULT_ID)
{
    // ID формы подписки
    if ($WEB_FORM_ID == 1) {
		if (!Loader::includeModule('subscribe')) {
			file_put_contents(
				$_SERVER['DOCUMENT_ROOT'].'/upload/subscribe_log.txt',
				"subscribe module not loaded\n",
				FILE_APPEND
			);

			return;
		}
		CFormResult::GetDataByID(
			$RESULT_ID,
			[],
			$result,
			$answers
		);

		$email = '';
		// printR($answers); 
		// $answ = json_encode($answers);

		// file_put_contents(
		// 	$_SERVER['DOCUMENT_ROOT'].'/upload/subscribe_log.txt',
		// 	"Answers: ".$answ."\n",
		// 	FILE_APPEND
		// );
		if (!empty($answers['email'][1]['USER_TEXT'])) {
			$email = trim($answers['email'][1]['USER_TEXT']);
		}

		if (!$email) {
			return;
		}

		// Проверяем существование подписчика
		$subscription = CSubscription::GetList(
			[],
			['EMAIL' => $email]
		);

		if ($subscription->Fetch()) {
			return;
		}

		$subscr = new CSubscription;

		$subscr->Add([
			'USER_ID' => null,
			'FORMAT' => 'html',
			'EMAIL' => $email,
			'ACTIVE' => 'Y',
			'SEND_CONFIRM' => 'N',
			'CONFIRMED' => 'Y'
		]);  
    }
}