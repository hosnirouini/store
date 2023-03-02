<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\TopsellersRepository;
use Container5L4arpb\getCategoryRepositoryService;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function  __construct(){

    }
    #[Route('/', name: 'app_main')]
    public function index(ProductRepository $productrep,TopsellersRepository $topsellerrep ,CategoryRepository $categoryrep): Response
    {

        $product = $categoryrep->findAll();
        $topseller = $topsellerrep->findAll();


        return $this->render('main/index.html.twig',['topsellers'=>$topseller,'products'=>$product]);
    }
    #[Route('/Buyproduct/{id}',name:'buy_now')]
    public function buynow(Product $product,int $id)
    {

    }
    #[Route('/showproduct/{id}',name:'show_product')]
    public function showproduct(ProductRepository $doctrine,int $id): Response
    {
        $product = $doctrine->find($id);

        return $this->render('main/single-product.html.twig',['product'=>$product]);

    }

    #[Route('/addtocart/{id}',name:'add_cart')]
    public function add(Product $product,int $id,SessionInterface $session)
    {
        $panier = $session->get("panier",[]);
        $id = $product->getId();
        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
         $session->set("panier",$panier);
        return $this->redirectToRoute('app_cart');
    }





    #[Route('/cart',name:'app_cart')]
    public function mycart(SessionInterface $session,ProductRepository $productrep)
    {
        $panier = $session->get("panier",[]);
        $datapanier = [];
        $total =0;

        foreach ($panier as $id=>$quantity)
        {
            $products = $productrep->find($id);
            $datapanier[] = [
                "produit"=>$products,
                "quantité"=>$quantity
            ];
            $total += $products->getPrice() * $quantity;
        }


        return $this->render('main/wishlist.html.twig',['panier'=>$datapanier]);
    }





    #[Route('/shop/1',name:'app_shop1')]
    public function cart1(CategoryRepository $category)
    {
        $products = $category->findBy(['name'=>'عبايات']);
        return $this->render('main/shop-grid.html.twig',['products'=>$products]);
    }
    #[Route('/shop/2',name:'app_shop2')]
    public function cart2(CategoryRepository $category)
    {
        $products = $category->findBy(['name'=>'عطور']);
        return $this->render('main/shop-grid.html.twig',['products'=>$products]);
    }


    #[Route('/myaccount',name:'app_my_account')]
    public function myaccount()
    {
            return $this->render('main/my-account.html.twig');
    }
    #[Route('/user_order_detail',name:'app_user_order_detail')]
    public function userorderdeails()
    {
        return $this->render('main/my-account.html.twig');
    }
    #[Route('/about',name:'app_about')]
    public function about()
    {
        return $this->render('main/about.html.twig');
    }
    #[Route('/stores',name:'app_sotres')]
    public function stores()
    {
        return $this->render('main/stores.html.twig');
    }
    #[Route('/shop_grid',name:'app_shop')]
    public function shop_grid()
    {
        return $this->render('main/shop-grid.html.twig');
    }

    #[Route('/contact',name:'app_contact')]
    public function contact()
    {
        return $this->render('main/contact.html.twig');
    }
    #[Route('/faq',name:'app_faq')]
    public function faq()
    {
        return $this->render('main/faqs.html.twig');
    }
    #[Route('/checkout',name:'app_checkout')]
    public function checkout()
    {
        return $this->render('main/checkout.html.twig');
    }

}
