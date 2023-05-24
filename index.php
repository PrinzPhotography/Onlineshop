<?php
require_once('libs/Smarty/lib/smarty/Smarty.class.php');
require_once ('php/Database.php');
require_once('php/Orders.php');
require_once ('php/cart.php');
require_once ('php/Article.php');
require_once ('php/User.php');
require_once ('vendor/autoload.php');

$smarty = new Smarty();
$databse = new Database();
$db = $databse->getDB();
if(!isset($_COOKIE['noUser'])) {
    $cookieId = random_int(0, 999);
    setcookie('noUser', $cookieId, time()+(86400 * 30),'/');
} else {
    $cookieId = $_COOKIE['noUser'];
}
if (isset($_GET['pageN'])) {
    $pageno = $_GET['pageN'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;
$sql = "SELECT COUNT(*) AS count FROM artikel";
$stmt = $db->query($sql);
$total_rows = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
$total_pages = ceil($total_rows / $no_of_records_per_page);

session_start();
$user = new User();
$cart = new Cart();
$order = new Orders();
$article = new Article();

require_once ('php/logout.php');
require_once ('php/delivery_address.php');
require_once ('php/shopping_cart.php');
require_once ('php/artikel_verwalten.php');

$href = "window.location.href='index.php?page=index&pageN={$pageno}'";
$smarty->assign('cartNumberLoggedIn', $cart->getCountCartNumber($_SESSION['id']));
$smarty->assign('cartNumberNotLoggedIn', $cart->getCountCartNumber($_COOKIE['noUser']));
$smarty->assign('isLoggedIn', isLoggedIn());
$smarty->assign('name', getFirstname($db));
$smarty->assign('cartSums', $cart->getCartSumForUserId($_COOKIE['noUser']));
$smarty->assign('bewertungen', $article->bewertungArtikel($_GET['artikel']));
$smarty->assign('durchschnittsBewertung', $article->durchschnittsBewertung());
$smarty->assign('admin', $_SESSION['admin']);
$smarty->assign('cartSums', $cart->getCartSumForUserId($_COOKIE['noUser']));
$smarty->assign('cartSum', $cart->getCartSumForUserId($_SESSION['id']));
$smarty->assign('href', $href);
$smarty->assign('pageno', $pageno);
$smarty->assign('first', 1);
$smarty->assign('last', $total_pages);


/*echo '<pre>';
var_dump($article->alleArtikel($no_of_records_per_page, $offset));
echo '</pre>';

var_dump($pageno);*/
switch ($_GET['page']){
    case 'home':
        $smarty->assign('favorites', $article->popularArticles());
        $smarty->assign('newArticle', $article->getNewArticles());
        $smarty->display('home.tpl');
        break;

    case 'bekleidung':

        $smarty->display('bekleidung.tpl');
        break;

    case 'agb':

        $smarty->display('agb.tpl');
        break;

    case 'pdf':

        $smarty->display('pdf.tpl');
        break;

    case 'impressum':

        $smarty->display('impressum.tpl');
        break;

    case 'kontakt':

        $smarty->display('kontakt.tpl');
        break;

    case 'hilfe':

        $smarty->display('hilfe.tpl');
        break;

    case 'lieferung_versand':
        $smarty->display('lieferung_versand.tpl');
        break;

    case 'login':

        $smarty->display('login.tpl');
        break;

    case 'sport_freizeit':

        $smarty->display('sport_freizeit.tpl');
        break;

    case 'haushalt_garten':

        $smarty->display('haushalt_garten.tpl');
        break;

    case 'spielzeug_baby':

        $smarty->display('spielzeug_baby.tpl');
        break;

    case 'elektronik_computer':

        $smarty->display('elektronik_computer.tpl');
        break;

    case 'neuer_artikel':
        if($_SESSION['admin'] === 'admin') {
            $rabattUndMwst = $article->getWarengruppeDetail(false, true);
            $smarty->assign('Info', $rabattUndMwst);
            $smarty->display('neuer_artikel.tpl');
        }
        break;

    case 'artikel_verwalten':
        if($_SESSION['admin'] === 'admin') {
            $articlelist = $article->articlelist();
            $smarty->assign('articlelist', $articlelist);
            $smarty->display('artikel_verwalten.tpl');
        }
        break;

    case 'artikel_bearbeiten':
        if($_SESSION['admin'] === 'admin') {
            $articleInfo = $article->getArticleInfo();
            $lagerStatus = [
                ['Status' => 'Auf Lager'],
                ['Status' => 'Bald wieder Lieferbar'],
                ['Status' => 'Zurzeit nicht im Angebot']
            ];
            $smarty->assign('articleInfo', $articleInfo);
            $smarty->assign('status', $lagerStatus);
            $smarty->display('artikel_bearbeiten.tpl');
        }
        break;

    case 'warengruppen':
        if($_SESSION['admin'] === 'admin') {
            $warengruppen = $article->getWarengruppen();
            $smarty->assign('warengruppen', $warengruppen);
            $smarty->display('warengruppen.tpl');
        }
        break;
    case 'warengruppe_verwalten':
        if($_SESSION['admin'] === 'admin') {
            $detail = $article->getWarengruppeDetail(true, false);
            $smarty->assign('detail', $detail);
            $smarty->display('warengruppe_verwalten.tpl');
        }
        break;
    case 'all_orders':
        $status = 'neu';
        $getAllOrders = $order->getAllOrders($status);
        $getAllOrderHistory = $order->getAllOrderHistorys($status);
        $allTotalPrices = $order->getAllOrderTotalPrices($status);
        $allTotalPrices = $order->getAllOrderTotalPrices($status);

        $smarty->assign('allOrders',$getAllOrders);
        $smarty->assign('allOrderHistory',$getAllOrderHistory);
        $smarty->assign('allTotalPrices',$allTotalPrices);
        $smarty->display('all_orders.tpl');
        break;

    case 'accepted_orders':
        $status = 'bestätigt';
        $getAllOrders = $order->getAllOrders($status);
        $getAllOrderHistory = $order->getAllOrderHistorys($status);
        $allTotalPrices = $order->getAllOrderTotalPrices($status);

        $smarty->assign('allOrders',$getAllOrders);
        $smarty->assign('allOrderHistory',$getAllOrderHistory);
        $smarty->assign('allTotalPrices',$allTotalPrices);
        $smarty->display('accepted_orders.tpl');
        break;


    case 'artikelseite':
        $smarty->assign('artikelseite', $article->artikelseite($cart->checkCartItem($_GET['artikel'])));
        $smarty->display('artikelseite.tpl');
        break;

    case 'artikeldetail':

        $smarty->display('artikeldetail.tpl');
        break;

    case 'registration':

        $smarty->display('registration.tpl');
        break;

    case 'artikeldetails_bearbeiten':
        if($_SESSION['admin'] === 'admin') {
            $smarty->display('artikeldetails_bearbeiten.tpl');
        }
        break;

    case 'profile':
        $smarty->display('profile.tpl');
        break;

    case 'my_orders';
    $getUserOrders = $order->getUserOrders($_SESSION['id']);
    $getUSerOrderHistory = $order->getUserOrderHistory($_SESSION['id']);
    $totalPrices = $order->getTotalPrice($_SESSION['id']);

    $smarty->assign('userOrders',$getUserOrders);
    $smarty->assign('userOrderHistory',$getUSerOrderHistory);
    $smarty->assign('totalPrices',$totalPrices);
    $smarty->display('my_orders.tpl');
    break;

    case 'delivery_addresses':
        $smarty->assign('deliveryAddresses', $order->getDeliveryAddressInfo());
        $smarty->display('delivery_addresses.tpl');
        break;

    case 'delivery_address':
        $smarty->display('delivery_address.tpl');
        break;

    case 'editDeliveryAddress':

        $smarty->assign('deliveryAddress', $order->deliv());
        $smarty->display('edit_delivery_address.tpl');
        break;

    case 'order_transaction':
        $zahlung = $user->getUserInfo($_SESSION['id']);
        $_SESSION['zahlung'] = $zahlung['zahlungsart'];
        $delivery    = $order->getDeliveryAddressInfo();
        $zahlungsarten = $order->getZahlungsarten();
        $zahlungsart = false;
        if(!is_null($_SESSION['zahlung'])) {
            $zahlungsart = $_SESSION['zahlung'];
        }
        $adr = false;
        if(!is_null($_SESSION['favAdr'])) {
            $adr = $_SESSION['favAdr'];
        }
        $smarty->assign('deliveryAddresses', $delivery);
        $smarty->assign('zahlung', $zahlungsart);
        $smarty->assign('adr', $adr);
        $smarty->assign('zahlungsarten', $zahlungsarten);
        $smarty->display('order_transaction.tpl');
        break;

    case 'suche':
        $smarty->assign('suche', $article->suche($_GET['anfrage']));
        $smarty->display('suche.tpl');
        break;

    case 'cart':

        if(!isLoggedIn()) {
            $smarty->assign('cartItems', $cart->getCartItemsForUserId($_COOKIE['noUser']));
            $smarty->assign('cartSum', $cart->getCartSumForUserId($_COOKIE['noUser']));
        } else {
            $smarty->assign('cartItems', $cart->getCartItemsForUserId($_SESSION['id']));
            $smarty->assign('cartSum',$cart->getCartSumForUserId($_SESSION['id']));
        }
        $smarty->display('shopping_cart.tpl');
        break;
    case 'orderHistory':
        $smarty->assign('userOrders',$order->getUserOrders($_SESSION['id']));
        $smarty->assign('userOrderHistory',$order->getAllOrderHistorys('null'));
        break;

    default :
        var_dump($pageno);
        $smarty->assign('alleArtikel', $article->alleArtikel($no_of_records_per_page, $offset));
        $smarty->display('index.tpl');
        break;
}