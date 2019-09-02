<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleCategoryValidator
 *
 * @author matan
 */
class ArticleCategoryValidator {
     public function validate($value) {
         $arr = ['news','guides','blog'];
         return in_array($value, $arr) ? TRUE : NULL;
     }
}
