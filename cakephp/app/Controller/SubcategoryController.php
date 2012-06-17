<?php
class SubcategoryController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('subCategories', $this->SubCategory->find('all'));
    }
}
?>
