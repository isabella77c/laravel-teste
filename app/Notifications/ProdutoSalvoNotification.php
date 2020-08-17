<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Produto;


class ProdutoSalvoNotification extends Notification
{
    use Queueable;

    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
           
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        
        return (new MailMessage)
                    ->subject("Produto Salvo: ".$this->produto->nome_produto)
                    ->line($this->produto->nome_produto." - Preço atual = ".$this->produto->valor);
                    
    }

   public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
