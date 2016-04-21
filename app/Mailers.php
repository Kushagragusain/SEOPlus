<?php

namespace App;

use App\User;

use Illuminate\Contracts\Mail\Mailer;

class Mailers
{
    protected $mailer;

    protected $from  ='gothicprakhar@gmail.com';

    protected $to;

    protected $view;

    protected $data= [];


    public function __construct(Mailer $mailer)
        {
            $this->mailer=$mailer;
        }

    public function sendEmailConfirmationTo(User $user)
    {

         $this->to =$user->email;

         $this->view = 'auth.emails.confirm';

         $this->data =compact('user');

         $this->deliver();

    }

    public function deliver()
         {

              $this->mailer->send($this->view,$this->data,function($message){

              $message->from($this->from,'Administrator')->to($this->to);


          });

         }
}
