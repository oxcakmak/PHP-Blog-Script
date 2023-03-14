# PHP-Blog-Script
PHP Blog Script / latest -1 oxcakmak.com


Merhaba arkadaşlar, bu makale de siz değerli yazılımcılara önceden kullandığım yazılımı vereceğim. Tamamen ücretsiz olup istediğiniz gibi kullanabilirsiniz, bu yazılımda sadece sayfa ve blog bulunmaktadır.

Bir çok kişi bu tip kurulumları bilmesine rağmen bu tip özel yazılımlarda yapı benzer olabilir fakat aradaki fark azımsanmayacak kadar az değildir.

### Kurulum nasıl yapılır?

-   indirdiğiniz zip dosyasını bir klasöre çıkarın
-   veritabanı oluşturup sql dosyasını içe aktarın (kullanıcı adı ve şifresi : admin admin dir)
-   admin.php dosyasını açıp
    -   953. satırda bulunan “**REPLACE_ME_GOOGLE_CAPTCHA**” data-sitekey bölümüne google recaptcha'dan aldığınız sitenizin keyini ekleyin.
    -   962/63/72. satırlarda bulunan açıklama “**//**” satırının sembollerini kaldırın.
-   config.php dosyasını açın
    -   Veritabanı bağlantısını (36 Nolu satır)
    -   Site adresi (48 Nolu satır)
    -   Sabitlemeyi kendinize göre ayarlayın (56 Nolu satır)
-   robots.txt ve cron.php dosyasını da açın ve siteyi kendi alan adınız ile değiştirin.

### English:
-   extract the downloaded zip file to a folder
-   create database and import sql file (username and password: admin admin )
-   open the admin.php file
     -   Add the key of your site that you got from google recaptcha to the “**REPLACE_ME_GOOGLE_CAPTCHA**” data-sitekey section on line 953.
     -   962/63/72. Remove the symbols of the comment “**//**” line in the lines.
-   open config.php file
     -   Database link on line 36
     -   Site address on line 48
     -   Adjust the fixing on line 56 according to you
-   Open the robots.txt and cron.php file as well and replace the site with your own domain name.

Daha sonra kullanıma başlayabilirsiniz. Ekran görüntüleri / Screenshots:

![](https://oxcakmak.com/assets/uploads/20230311/a5c7e60ad3a9dd5f28e7a6f2179d40168998ace6.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/39ce54bf203b221a02866bca2059bd3acd0a3949.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/cd3dde026cd67cd43a06bc153a62fa25290538ee.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/b71878e75b4d9bdccec8bd5bc66122a08b18333a.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/bb5bd2d850846395f7998c19a18bb7e210f0e60a.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/fc6a2a3324607d182c55e32692de412bb986de2d.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/3b6ebf191240feedcccee8a9bbd85d0cbbac3511.jpg)
-
![](https://oxcakmak.com/assets/uploads/20230311/b0cd1d660484e82fde755fa37b701d598fe0d74a.jpg)
