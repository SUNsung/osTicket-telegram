# osTicket telegram
Plugin for osTicket to receive alerts for new tickets or updating old ones

Written on the basis of the old crooked telegram plugin and a beautiful new plugin for Slack


ALL types of id are supported: -434234234, 234424224, @dfsdfsdf

You enter only chat id and bot key
The bot key is also in plain text, without links, methods, etc.

No links, etc.

There is a third field with useragent, this is for those whose updates are tapped through the cron and the network itself is spread out in a tricky way, which is why an empty request without identifiers is wrapped in a telegram. By default, this field is already filled in.


Use the checkboxes to set which events to receive notifications.

# ============================================
![img plugin](https://raw.githubusercontent.com/SUNsung/osTicket-telegram/master/Screenshot_2020-10-04%20osTicket%20%D0%9F%D0%B0%D0%BD%D0%B5%D0%BB%D1%8C%20%D0%A3%D0%BF%D1%80%D0%B0%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F%20%D0%90%D0%B4%D0%BC%D0%B8%D0%BD%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%82%D0%BE%D1%80%D0%B0.png)
# ============================================
# osTicket telegram
Плагин для osTicket что бы получить оповещения при новых тикитов или обновлении старых

Написан на основе старого кривого плагина по телеграмму и нового красивого плагина к Slack


Поддерживаются ВСЕ виды id: -434234234, 234424224, @dfsdfsdf

Вы вводите только id-чата и ключ бота
Ключ бота так же простым текстом, без ссылок, методов и прочего

Никаких ссылок и тд

Есть третье поле с useragent, это для тех у кого обновления тапаются через крон и сама сеть раскинута по хитрому из-за чего пустой без идентификаторов запрос заворачиватся телеграммом.  По умолчанию это поле уже заполнено.


Галочками задаете по каким событиям получать оповещения.


UPD[16.05.2022] Бот серьезно переписался, добавилась поддержка markdwn2, переходы сделаны на кнопках, добавил возможность отвечать на сообщения прямо в телеграм-боте. Если кого-то интересует пишите в issules потому как вычесать под публичное выкладывание у меня руки вряд ли дойдут.

