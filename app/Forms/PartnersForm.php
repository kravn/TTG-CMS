<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PartnersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => trans('admin.fields.partner.title')
            ])
            ->add('logo', 'file', [
                'label' => trans('admin.fields.partner.logo')
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