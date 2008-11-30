<?
function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }
//$banner = new Banner();
$bannerHTML = new BannerHTML();
//$bannerDAO = new BannerDAO();
$bannerHTML->ADDALTBanner();
?>