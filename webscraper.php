<?php

class Webscraper
{
    private $address;

    public function __construct($webadress)
    {
        $this->address = $webadress;
    }

    public function curlNormal()
    {
        $ch = curl_init($this->address);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);

        $curl_error = curl_error($ch);
        
        #strip content
        $outtext = curl_multi_getcontent($ch);
        #$outtext = mb_ereg_replace('[\>]', '> ', $outtext);
        #$outtext = mb_ereg_replace('[\<]', ' <', $outtext);
        #$outtext = strip_tags($outtext);
        #$outtext = preg_replace('!\s+!', ' ', $outtext);

        return $outtext;
    }

    private function setRedirectedUrl()
    {
        $ch = curl_init($this->address);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);

        $redirected_url = curl_getinfo($ch)['redirect_url'];
        if(!empty( $redirected_url)){
            $this->address = $redirected_url;
        }
    }

    public function curl()
    {
        $this->setRedirectedUrl();
        return $this->curlNormal();
    }
}
