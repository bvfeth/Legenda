<?php
// ==========================================
// НАСТРОЙКИ ТЕЛЕГРАМ
// ==========================================

$botToken = "8614750883:AAGjG4ul3jiuYl4PyxgQ2g8kNsfIak22PUA";
$chatId = "258501091";  // ← ТОЛЬКО НИКИТА (@samarabasketball)

// ==========================================
// ПОЛУЧАЕМ ДАННЫЕ ИЗ ФОРМЫ
// ==========================================

$name = isset($_POST['name']) ? $_POST['name'] : 'Не указано';
$phone = isset($_POST['phone']) ? $_POST['phone'] : 'Не указано';
$age = isset($_POST['age']) ? $_POST['age'] : 'Не указано';
$message = isset($_POST['message']) ? $_POST['message'] : 'Не указано';

// ==========================================
// ФОРМИРУЕМ СООБЩЕНИЕ
// ==========================================

$text = "🏀 НОВАЯ ЗАЯВКА!\n";
$text .= "━━━━━━━━━━━━━━━━━━\n\n";
$text .= "👤 Имя: " . $name . "\n";
$text .= "📞 Телефон: " . $phone . "\n";
$text .= "📅 Возраст: " . $age . "\n";
$text .= "💬 Сообщение: " . $message . "\n\n";
$text .= "━━━━━━━━━━━━━━━━━━\n";
$text .= "📅 Дата: " . date('d.m.Y H:i:s');

// ==========================================
// ОТПРАВЛЯЕМ В TELEGRAM
// ==========================================

$url = "https://api.telegram.org/bot" . $botToken . "/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// ==========================================
// РЕЗУЛЬТАТ
// ==========================================

if ($result === false) {
    echo "❌ Ошибка при отправке заявки. Попробуйте позже.";
} else {
    echo "✅ Спасибо! Ваша заявка отправлена. Мы свяжемся с вами!";
}
?>