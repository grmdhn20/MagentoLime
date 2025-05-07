<?php
namespace Lime\Sample\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Hello extends Action
{
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Lime Sample</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #2e7d32;
            text-align: center;
        }
        h1 {
            font-size: 3em;
            margin: 0;
            animation: fadeInDown 1s ease-out forwards;
            text-shadow: 0 0 10px #ffffff, 0 0 20px #ffffff;
        }
        p {
            font-size: 1.2em;
            color: #333;
            margin-top: 10px;
            animation: fadeInUp 1.5s ease-out forwards;
        }
        .badge {
            background: #ffffffcc;
            padding: 10px 20px;
            margin-top: 30px;
            border-radius: 10px;
            font-weight: bold;
            color: #388e3c;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            animation: fadeInUp 2s ease-out forwards;
        }
        .back-button {
            background: #388e3c;
            color: #fff;
            border: none;
            padding: 12px 30px;
            margin-top: 40px;
            border-radius: 10px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .back-button:hover {
            background: #2e7d32;
        }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
            .badge {
                font-size: 0.9em;
                padding: 8px 16px;
            }
            .back-button {
                font-size: 0.9em;
                padding: 10px 25px;
            }
        }
    </style>
</head>
<body>
    <h1>👋 Hello World, from LimeCommerce!</h1>
    <p>Crafted with love by Gilang Ramadhana Alt-Thariq</p>
    <div class="badge">Responsive Mode? Tab & Mobile Friendly ✅</div>
    <button class="back-button" onclick="window.location.href='http://local.magento/'">Back to Home</button>
</body>
</html>
HTML;
        $result->setContents($html);
        return $result;
    }
}
