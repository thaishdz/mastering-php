<?php
/*
* Los enum no pueden ser declarados directamente dentro de una clase como propiedades en PHP. 
* Los enum en PHP deben ser definidos fuera de cualquier clase, como una estructura global.
* Es por eso que simularemos que está fuera de clase en este mismo archivo
*/

enum Status: string {
    case PENDING   = 'pending';
    case SHIPPED   = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}
 
class Order 
 {
    private int $id;
    private static int $count = 1;
    private Status $status;

    public function __construct()
    {
        $this->id = self::$count++;
        $this->status = Status::PENDING;
    }

    public function id() : int 
    {
        return $this->id;
    }

    public function status(): string
    {
        return $this->status->value;
    }

    public function ship()
    {
        if($this->status == Status::PENDING){
            $this->status = Status::SHIPPED; // Se cambia en el propio objeto y en Base de datos I guess
            echo "Pedido enviado\n";
        }else{
            echo "No se pudo enviar el pedido\n";
        }
    }

    public function cancel()
    {
        if($this->status == Status::PENDING){
            $this->status = Status::CANCELLED;
            echo "Pedido cancelado\n";
        }else {
            echo "No se puede cancelar un pedido enviado\n";
        }
    }


    public function deliver()
    {
        if($this->status == Status::SHIPPED){
            $this->status = Status::DELIVERED;
            echo "Pedido entregado\n";
        }else{
            echo "No se puede entregar un pedido que no ha sido enviado\n";
        }
    }

 }


$order_1 = new Order();
$order_2 = new Order();
$order_3 = new Order();

echo $order_2->send();
echo $order_3->deliver();

echo $order_2->status();
echo $order_2->cancel();
