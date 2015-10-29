<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CarouselsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('language_id', 'choice', [
                'choices' => $this->data,
                'label' => trans('admin.fields.carousel.language_id')
            ])
            ->add('title', 'text', [
                'label' => trans('admin.fields.carousel.title')
            ])
            ->add('image', 'file', [
                'label' => trans('admin.fields.carousel.image')
            ])
            ->add('description', 'text', [
                'label' => trans('admin.fields.carousel.description')
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