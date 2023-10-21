<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VideosCrudController extends AbstractCrudController
{
   public static function getEntityFqcn(): string
   {
      return Video::class;
   }


   public function configureFields(string $pageName): iterable
   {
      return [
         TextField::new('url'),
         TextField::new('title'),
         TextField::new('description'),
         TextField::new('category')
      ];
   }

}
