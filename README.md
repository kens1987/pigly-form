##  ピグリーフォーム  
###  Docker  
・git clone(git@github.com:kens1987/pigly-form.git)  
・docker-compose up -d --build  
###  Laravel環境構築  
・docker-compose exec php bash  
・composer install  
・.envファイルは.env.exampleをコピーし以下を修正  
    DB_HOST=127.0.0.1 → mysql  
    DB_DATABASE=laravel → laravel_db  
    DB_USERNAME=root → laravel_user  
    DB_PASSWORD= → laravel_pass  
・php artisan key:generate  
・php artisan migrate  
・php artisan db:seed  
###  使用技術  
###  ER図  
###  URL  
・ピグリーフォーム：http://localhost/register/step1  
・php MyAdmin：  http://localhost:8080/  
