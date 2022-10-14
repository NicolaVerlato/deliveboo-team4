<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Restaurant;
use App\DishOrder;
use App\Dish;

class SendCustomerNewMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $restaurant = Restaurant::findOrFail($this->order->restaurant_id);
        $orderRecap = DishOrder::where('order_id', '=', $this->order->id)->get();
        $allRestaurantDishes = Dish::where('restaurant_id', '=', $restaurant->id)->get();
        
        $data = [
            'order' => $this->order,
            'orderRecap' => $orderRecap,
            'allRestaurantDishes' => $allRestaurantDishes
        ];

        return $this->view('emails.new-order-customer-email', $data);
    }
}
