# Laravel Cashier - Stripe

Um Sistema completo de assinaturas usando o Laravel Cashier (integrar diretamente com a API Stripe)

### Instalação

Clonar Projeto
```sh
git clone https://github.com/ezequieldhonatan/laravel-cashier-stripe
```

Acessar o projeto
```sh
cd laravel-cashier-stripe
```

Criar o Arquivo .env
```sh
cp .env.example .env
```

Subir os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec laravel_cashier_stripe bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Acessar o projeto
[http://localhost:8000](http://localhost:8000)
