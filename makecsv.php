
<?php
//php 설정 파일
header('Content-Type:text/css;charset=EUC-KR;');
header('Expires: 0');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: private, no-transform, no-store, must-revalidate');

//config 파일
include_once($_SERVER["DOCUMENT_ROOT"]."/lib/config/config.php");

//db 생성 및 연결
$objDBH = new DB();
$arrData = $objDBH->getRows("select * from member");

//첫행
$csv_dump='';
$csv_dump .= "code,id,name";
$csv_dump .= "\r\n";

//반복행
foreach($arrData['list'] as $key => $val) {
    $csv_dump .= filterData($val['code']).",";
    $csv_dump .= filterData($val['id']).",";
    $csv_dump .= filterData($val['name'])."";
    $csv_dump .= "\r\n";

}

//타이틀에 쓰일 날짜 시간 분
$date = date("YmdHi");

//저장
file_put_contents($date."s.csv",  $csv_dump);

//실행결과
echo $csv_dump;

//쉼표 필터 함수, 한글화 처리
function filterData($string) {
    $string=iconv("UTF-8","EUC-KR",($string));
    return $string;
}

?>
