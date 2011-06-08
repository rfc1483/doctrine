<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Acme\StoreBundle\Form\ProductType;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('AcmeStoreBundle:Default:index.html.twig');
    }

    public function createAction() {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->get('doctrine')->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id ' . $product->getId());
    }

    public function updateAction() {

        $product = new Product();

        $form = $this->get('form.factory')
                ->create(new ProductType(), $product);
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getEntityManager();
                $product = $em->getRepository('AcmeStoreBundle:Product')->find($product->getId());

                if (!$product) {
                    throw $this->createNotFoundException('No product found for id ' . $product->getId());
                }

                $product->setName('New product name!');
                $em->flush();
                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('AcmeStoreBundle:Default:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction() {
        $product = new Product();

        $form = $this->get('form.factory')
                ->create(new ProductType(), $product);
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getEntityManager();
                $product = $em->getRepository('AcmeStoreBundle:Product')->find($product->getId());

                if (!$product) {
                    throw $this->createNotFoundException('No product found for id ' . $product->getId());
                }

                $em->remove($product);
                $em->flush();
                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('AcmeStoreBundle:Default:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function createProductAction() {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setDescription('Bar');
        $product->setPrice(19.99);
        // relate this product to the category
        $product->setCategory($category);

        $em = $this->get('doctrine')->getEntityManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
                'Created product id: ' . $product->getId() . ' and category id: ' . $category->getId()
        );
    }

}
