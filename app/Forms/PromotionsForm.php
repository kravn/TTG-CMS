<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PromotionsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('language_id', 'choice', [
                'choices' => $this->data,
                'label' => trans('admin.fields.promotion.language_id')
            ])
            ->add('title', 'text', [
                'label' => trans('admin.fields.promotion.title')
            ])
            ->add('promotions_id', 'text', [
                'label' => trans('admin.fields.promotion.promo_id')
            ])
            ->add('content', 'textarea', [
                'label' => trans('admin.fields.promotion.content')
            ])
            ->add('save', 'submit', [
                'label' => trans('admin.fields.save'),
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->add('clear', 'reset', [
                'label' => trans('admin.fields.reset'),
                'attr' => ['class' => 'btn btn-warning']
            ]);
    }
}