<?php

namespace App\Mailers;
class Mailer
{
    public $fromEmail = 'box@zlad.tk';
    public $fromName = config( 'app.name' );

    public function sendReminder( $registration )
    {
        return $this->send( 'reminder', $registration->contact, $registration, 'You have a pending payment!' );
    }

    public function send( $template, $contact, $data, $subject )
    {
        $subject .= ' debug: ' . date( 'd.m H:i:s' );
        if ( !$contact->hashcode )
        {
            $contact->hashcode = md5( $contact->email );
            $contact->save();
        }
        $result = \Mail::send( 'emails.' . $template, [ 'contact' => $contact, 'data' => $data ], function ( $m ) use ( $contact, $data, $subject )
        {
            $m->from( $this->fromEmail, $this->fromName );
            $m->to( $contact->email, $contact->name )->subject( $subject );
        } );

        $fail = \Mail::failures();
        if ( !empty( $fail ) )
        {
            throw new \Exception( 'Could not send message to ' . $fail[ 0 ] );
        }

        //if(empty($result)) throw new \Exception('Email could not be sent.');
    }

    public function sendConfirmation( $registration, $coupon = null )
    {
        return $this->send( 'confirmation', $registration->contact, [
            'registration' => $registration,
            'coupon' => $coupon,
        ], 'Your registration details' );
    }

    public function sendInvitation( $contact, $event )
    {
        return $this->send( 'invitation', $contact, $event, 'Check out our new event!' );
    }

}
