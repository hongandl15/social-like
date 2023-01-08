<?php
class Api
{
    /** API URL */
    public $api_url = 'https://5gsmm.com/api/v2';

    /** Your API key */

public $api_key = '100d9d62589bcf418184b7c7644cb52f';

    /** Add order */
    public function order($data)
    {
        $post = array_merge(['key' => $this->api_key, 'action' => 'add'], $data);
        return json_decode($this->connect($post));
    }

    /** Get order status  */
    public function status($order_id)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'status',
                'order' => $order_id
            ])
        );
    }

    /** Get orders status */
    public function multiStatus($order_ids)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'status',
                'orders' => implode(",", (array)$order_ids)
            ])
        );
    }

    /** Get services */
    public function services()
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'services',
            ])
        );
    }

    /** Get balance */
    public function balance()
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'balance',
            ])
        );
    }

    private function connect($post)
    {
        $_post = [];
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (is_array($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result = false;
        }
        curl_close($ch);
        return $result;
    }
}

// Examples

$api = new Api();

$services = $api->services(); # Return all services

$balance = $api->balance(); # Return user balance

// // Add order

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'runs' => 2, 'interval' => 5]); # Default

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'comments' => "good pic\ngreat photo\n:)\n;)"]); # Custom Comments

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'hashtag' => "test"]); # Mentions Hashtag

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 1000, 'usernames' => "test"]); # Mentions

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test']); # Package

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'runs' => 10, 'interval' => 60]); # Drip-feed

// // Old posts only
// $order = $api->order(['service' => 1, 'username' => 'username', 'min' => 100, 'max' => 110, 'posts' => 0, 'delay' => 30, 'expiry' => '11/11/2022']); # Subscriptions

// // Unlimited new posts and 5 old posts
// $order = $api->order(['service' => 1, 'username' => 'username', 'min' => 100, 'max' => 110, 'old_posts' => 5, 'delay' => 30, 'expiry' => '11/11/2022']); # Subscriptions

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'username' => "test"]); # Comment Likes

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'answer_number' => '7']); # Poll


// $status = $api->status($order->order); # Return status, charge, remains, start count, currency

// $statuses = $api->multiStatus([1, 2, 3]); # Return orders status, charge, remains, start count, currency
