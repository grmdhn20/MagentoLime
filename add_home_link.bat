@echo off
REM Path ke tema custom Lime Luma
set THEME_PATH=app\design\frontend\Lime\Luma

REM Buat struktur direktori jika belum ada
mkdir %THEME_PATH%\Magento_Theme\layout

REM Buat file default.xml untuk menambahkan link Home
echo ^<?xml version="1.0"?> > %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd"^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^    ^<body^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^        ^<referenceBlock name="catalog.topnav"^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^            ^<block class="Magento\Framework\View\Element\Html\Link" name="custom-home-link"^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^                ^<arguments^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^                    ^<argument name="label" xsi:type="string"^>Home^</argument^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^                    ^<argument name="path" xsi:type="string"^>/^</argument^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^                ^</arguments^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^            ^</block^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^        ^</referenceBlock^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^    ^</body^> >> %THEME_PATH%\Magento_Theme\layout\default.xml
echo ^</page^> >> %THEME_PATH%\Magento_Theme\layout\default.xml

REM Flush cache dan deploy static content
php bin\magento setup:upgrade
php bin\magento cache:flush
php bin\magento setup:static-content:deploy -f

echo.
echo Home link berhasil ditambahkan!
pause
