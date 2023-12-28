TechTGPHP - Библиотека для работы с Telegram Bot API на PHP
Описание:
TechTGPHP — это простая PHP-библиотека, предназначенная для упрощения взаимодействия с Telegram Bot API. Библиотека предоставляет набор методов для отправки различных сообщений, фотографий и документов, а также для работы с кнопками и другими функциями Telegram Bot API.

Методы:
1. sendMessage($chatId, $text)
Отправляет текстовое сообщение в указанный чат.

2. sendPhoto($chatId, $photoPath, $caption = '')
Отправляет фотографию в указанный чат с опциональным описанием.

3. sendDocument($chatId, $documentPath, $caption = '')
Отправляет документ в указанный чат с опциональным описанием.

4. sendMessageWithButton($chatId, $text, $buttonText, $buttonData)
Отправляет текстовое сообщение с кнопкой в указанный чат.

Требования:
PHP 7.0 и выше
Расширение cURL для PHP

Лицензия:
Эта библиотека распространяется под лицензией MIT. Вы можете свободно использовать, изменять и распространять ее в соответствии с условиями этой лицензии.
