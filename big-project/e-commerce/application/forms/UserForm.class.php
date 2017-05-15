<?php

class UserForm extends Form{

    public function build()
    {
        // TODO: Implement build() method.
        $this->addFormField('lastname');
        $this->addFormField('firstname');
        $this->addFormField('address');
        $this->addFormField('city');
        $this->addFormField('zipCode');
        $this->addFormField('phone');
        $this->addFormField('email');
    }
}