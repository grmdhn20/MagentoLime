# Magento Lime Project Showcase

**Project Overview:** This project involved setting up a complete Magento 2.4.4 environment from scratch, including local server configuration, module creation, and GitHub deployment. The main tasks included disabling Elasticsearch, configuring local domains, building custom modules, and integrating top menu links without modifying core files.

---

## **Project Steps:**

### **1. Initial Setup**

* Installed XAMPP as the local server environment on Windows 11.
* Created a new project directory `magentolime` in the XAMPP `htdocs` folder.
* Set up MySQL database `magentolime` with UTF-8 collation.
* Installed Composer globally to manage PHP dependencies.

### **2. Configuring Virtual Host (local.magento)**

* Updated the `hosts` file to point `local.magento` to the local IP address.
* Configured the Apache virtual hosts file to map `local.magento` to the Magento project directory.
* Verified the local domain was working correctly.
![image](https://github.com/user-attachments/assets/2950c84d-ad07-4f15-8100-512c9c6dc31d)


### **3. Installing Magento 2.4.4 (Elasticsearch Disabled)**

* Disabled Elasticsearch modules to optimize for local setup (including doing Composer Setup for Magento):

```terminal
php bin/magento module:disable Magento_Elasticsearch Magento_Elasticsearch6 Magento_Elasticsearch7 Magento_InventoryElasticsearch
```

![image](https://github.com/user-attachments/assets/6cd93876-dec3-4106-afe6-1861184ec05b)

* Installed Magento via Composer:

```Terminal
php bin/magento setup:install \
--base-url=http://local.magento/ \
--db-host=localhost \
--db-name=magentolime \
--db-user=root \
--db-password= \
--admin-firstname=Admin \
--admin-lastname=User \
--admin-email=admin@example.com \
--admin-user=admin \
--admin-password=Admin123! \
--language=en_US \
--currency=IDR \
--timezone=Asia/Jakarta \
--use-rewrites=1
```
![image](https://github.com/user-attachments/assets/1ea1bbf0-3b1c-4166-8ae3-07f173e2746c)


### **4. Creating the Custom Module (Lime\_Sample)**

* Created the custom module directory structure:

```
app/code/Lime/Sample/
├── etc/
│   └── module.xml
├── registration.php
├── Controller/
│   └── Index/
│       └── Hello.php
└── view/
    └── frontend/
        ├── layout/
        │   └── sample_index_hello.xml
        └── templates/
            └── hello.phtml
```

* Registered the module:

```php
<?php
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Lime_Sample',
    __DIR__
);
```

* Configured the module (`module.xml`):

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Lime_Sample" setup_version="1.0.0" />
</config>
```
![image](https://github.com/user-attachments/assets/826df4b7-0a7b-4322-add4-8ec9727a7e6f)

### **5. Adding Custom Navigation Links**

* Created a plugin to add 'Home' and 'Hello!' links to the main navigation menu without modifying core files:

```
app/code/Lime/CustomLink/
├── etc/
│   └── frontend/
│       └── di.xml
├── Plugin/
│   └── AddCustomLink.php
└── registration.php
```

* Plugin configuration (`di.xml`):

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="Magento\Theme\Block\Html\Topmenu">
        <plugin name="lime-custom-link-plugin" type="Lime\CustomLink\Plugin\AddCustomLink" />
    </type>
</config>
```

* Plugin logic (`AddCustomLink.php`):

```php
<?php
namespace Lime\CustomLink\Plugin;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class AddCustomLink
{
    protected $nodeFactory;
    protected $urlBuilder;

    public function __construct(NodeFactory $nodeFactory, UrlInterface $urlBuilder)
    {
        $this->nodeFactory = $nodeFactory;
        $this->urlBuilder = $urlBuilder;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        $menu = $subject->getMenu();

        // Add Home link
        $homeNode = $this->nodeFactory->create([
            'data' => [
                'name' => __('Home'),
                'id' => 'custom-home-link',
                'url' => $this->urlBuilder->getUrl('/'),
                'has_active' => false,
                'is_active' => false
            ],
            'idField' => 'id',
            'tree' => $menu->getTree()
        ]);
        $menu->addChild($homeNode);

        // Add Hello link
        $helloNode = $this->nodeFactory->create([
            'data' => [
                'name' => __('Hello!'),
                'id' => 'custom-hello-link',
                'url' => $this->urlBuilder->getUrl('sample/index/hello'),
                'has_active' => false,
                'is_active' => false
            ],
            'idField' => 'id',
            'tree' => $menu->getTree()
        ]);
        $menu->addChild($helloNode);
    }
}
```
![image](https://github.com/user-attachments/assets/a17ca0b3-b9c1-48bc-a213-936930b1e211)


### **🗒️ Project Status**
![image](https://github.com/user-attachments/assets/f567cbbe-7ff2-43bb-a170-059b6981eb04)
![image](https://github.com/user-attachments/assets/9017a386-27a1-45ad-956d-6fe2c0332779)

Project successfully deployed and fully functional, including:

* Full Magento installation without Elasticsearch
* Custom modules with personalized styling
* Custom Link (Home & Hello)
* Done installing product slider from Mageplaza
* Done without editing Magento Core Code

---
