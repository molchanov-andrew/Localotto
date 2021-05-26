<?php
/**
 * Date: 5/22/18
 */

namespace backend\controllers;

use backend\models\MigrateOldData;
use common\models\records\Image;
use yii\db\Connection;
use yii\web\Controller;

/* @property Connection $db */
class MigratingOldDataController extends Controller
{
    public function actionAll()
    {
        $time_start = microtime(true);
        /** time counting began */
// убрана валидация в backend/models/validators/PageUniqueValidator.php на обязательное наличие брокер у лоттореи
// имена файлов-изображений должны иметь формат *.png а не *.PNG
// таблицу Setting не чистить!
// в таблице LotteryResult поле mainNumbers изменить varchar -> text
// migrateLanguages()  данные в пустую таблицу не смигрируют. Должна быть хотя бы одна запись
// таблица Pages содержит две записи мейн пейдж с одинаковым языком '6172', 'MainPage', '', '', '', '', '', '', '', '<h1>Content 1</h1>', '<h1>Content 2</h1>', '0', '1', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00'
// таблица Pages не верно указан LanguageId. page_id '5375', 'LottoPage', 'Результаты Новая Зеландия Play 3 – Номера Новая Зеландия Play 3', '', '', 'результаты новая зеландия play 3,номера новая зеландия play 3,новая зеландия play 3,play 3 новая зеландия,nz лото play 3', 'Ищите результаты Новая Зеландия Play 3? Интересно, кому в этот раз удалось выиграть джекпот? Узнайте последние номера Новая Зеландия Play 3 и новости лотереи на сайте Localotto! Не сомневайтесь в том, чтобы начать играть сейчас, ведь шансы на выигрыш как никогда высоки!', '', '', '<h1>Результаты Новая Зеландия Play 3</h1><p style=\"text-align: justify;\">Цель нашей команды состоит в том, чтобы помочь нашим читателям всегда оставаться в курсе последних новостей и трендов из мира лотерей. В частности, мы подготовили обзор Новая Зеландия Play 3, лотереи, которая определенно заслуживает вашего внимания. Составляя обзор, мы постарались затронуть наиболее важные для игроков аспекты игры, в особенности обратив внимание на результаты Новая Зеландия Play 3. Приятного чтения!</p>\n', '<h2>Общая информация о Play 3 Новая Зеландия</h2><p style=\"text-align: justify;\">Страна происхождения лотереи – это Новая Зеландия,  а основали ее в 2014 году, [date_counter|06/10/2014]. В данный момент, Новая Зеландия является единственной страной, где можно сыграть в NZ Лото Play 3. Появилась она достаточно давно, но название NZ Лото Play 3 ни разу не менялось. С момента первого тиража формат игры не изменился. Оператором лотереи является MyLotto. Если вам интересно узнать о MyLotto побольше, у оператора есть официальный сайт: https://mylotto.co.nz. Результаты Новая Зеландия Play 3, кстати, на нем тоже есть. Что касается возможности выйти на связь, MyLotto предоставляет следующие контакты: номер телефона – 64 9356 3685 и э-мейл – customersupport@mylotto.co.nz.  Также нам удалось узнать, что оператор зарегистрирован в г. Окленд. Имейте в виду, что играть разрешается не раньше чем с 18.</p><h2>Узнайте результаты Новая Зеландия Play 3</h2><p style=\"text-align: justify;\">Результаты Новая Зеландия Play 3 озвучивают сразу после розыгрышей, которые проводят в главном офисе MyLotto в г. Окленд. Вообще, тиражи проходят семь раз в неделю. Иными словами, попытаться сыграть можно в любой день,  а именно в 18:00.  Сами же номера Новая Зеландия Play 3 выбирают с помощью лотерейного барабана. Если вдруг вам было интересно, первый тираж лотереи прошел 6 октября 2014 года, [date_counter|06/10/2014].</p><h3>Как выбрать номера Новая Зеландия Play 3</h3><p style=\"text-align: justify;\">На сегодняшний день применяется следующий формат: 3 / 0-9. Таким образом, главные номера Новая Зеландия Play 3, которых, как вы видите, насчитывается 3,  предстоит выбрать из ряда чисел 0-9. Обратите внимание, что в Play 3 Новая Зеландия не предусмотрено ни бонусных, ни дополнительных номеров. </p><h3>Шансы на выигрыш и призовые категории Play 3 Новая Зеландия</h3><p style=\"text-align: justify;\">Количество призовых категорий, предлагаемых лотереей, составляет 4. Джекпота в NZ Лото Play 3 нет, тогда как сумма главного приза является достаточно скромной. На сегодня, она составляет NZ $500 ([money|500,NZD]). И все же, факт того, что джекпот считается весьма скромным, компенсируется действительно высокими шансами на выигрыш!   Как указано в официальных источниках, вероятность выиграть джекпот составляет 1 : 1,000. В частности, необходимо будет угадать все основные номера Новая Зеландия Play 3, которых насчитывается 3.  Более детальную информацию о системе распределения призов можно найти на официальном сайте NZ Лото Play 3, тогда как ниже представлены основные данные о призовых категориях:</p><table style=\"width: 100%\">\n            <tr>\n                        <th><p style=\"text-align:center\"><strong>Призовая категория</strong></p></th>\n                        <th><p style=\"text-align:center\"><strong>Призы</strong></p></th>\n                        <th><p style=\"text-align:center\"><strong>Выигрышные шансы</strong></p></th>\n                    </tr>\n    \n        <tr>\n                        <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                                Точный порядок\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                [choose_currency|500,NZD]\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                1 : 1,000\n\n                            </p></td>\n            </tr>\n        <tr>\n                        <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                                Произвольный порядок\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                [choose_currency|80,NZD]\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                1 : 133\n\n                            </p></td>\n            </tr>\n        <tr>\n                        <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                                Произвольный порядок\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                [choose_currency|160,NZD]\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                1 : 167\n\n                            </p></td>\n            </tr>\n        <tr>\n                        <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                                Пары\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                [choose_currency|17,NZD]\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                1 : 100\n\n                            </p></td>\n            </tr>\n        <tr>\n                        <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                                Комбо\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                [choose_currency|500,NZD]\n                            </p></td>\n                <td style=\"width:33.333333333333%;\"><p style=\"text-align:center\">\n                                1 : 133 / 1 : 167\n                            </p></td>\n            </tr>\n    </table><p style=\"text-align: justify;\">Таким образом, общие шансы на выигрыш – это 1 : 5.6 (17.9﻿%).</p><h3>Цены Play 3 Новая Зеландия</h3><p style=\"text-align: justify;\">Минимальная стоимость игры составляет NZ $1 ([money|1,NZD]). При этом, возможности увеличить свой потенциальный приз у игроков нет. Дополнительных игр не предлагается.</p><h4>Горячие и холодные номера Новая Зеландия Play 3</h4><p style=\"text-align: justify;\">Горячие, то есть наиболее часто выбираемые номера Новая Зеландия Play 3, это 3, 9, 0. К холодным номерам относятся следующие: 1, 2, 4.</p><h4>Выплата призов Play 3 Новая Зеландия</h4><p style=\"text-align: justify;\">Имейте в виду, что джекпот NZ Лото Play 3 выплачивается исключительно разовым платежом. Для того чтобы оформить выплату приза первой категории, необходимо будет лично посетить главный офис оператора в г. Окленд. Что касается призов Play 3 Новая Зеландия других категорий, за ними можно обратиться в один из региональных офисов. Имейте в виду, что это касается призов суммой в NZ $1,000 ([money|1000,NZD]). Отлично то, что с выигрыша NZ Лото Play 3 не взимаются налоги. Есть еще одна вещь, на которую стоит обратить внимание, а именно тот факт, что у игроков есть один год чтобы забрать выигрыш. В ином случае, выигрышный билет окажется недействительным, несмотря даже на то, какими были результаты Новая Зеландия Play 3.</p>\n', '0', '1', '0', '356', '0', '0', '0', '1', '0', '1', '0', '0', '2018-07-20 14:34:54'
// таблица Pages лишняя запись с одним и тем же is_lottery и id_languages. page_id - '6136', 'LottoPage', 'Arizona Fantasy 5 Results - Find Your Winnings Numbers Here', '', '', 'arizona fantasy 5 results,play az fantasy 5,arizona fantasy 5 numbers,az latest fantasy 5 winning numbers,arizona fantasy 5 latest winning numbers,claim arizona fantasy five winnings', 'Check Arizona Fantasy 5 results on our website. Here you can find Arizona Fantasy 5 numbers, as well as, some key rules, ways of claiming the prizes, and record jackpots. Stay updated with Localotto! ', '', '', '<h1>Arizona Fantasy 5 Results</h1>\n\n<p style=\"text-align:justify\">Fantasy 5 is a lotto game and a newer version of its predecessor - Pick 5 game. The lottery was launched in 1991 in the US. On our website, you will find Arizona Fantasy 5 results, as well as ways to claim Arizona Fantasy Five&nbsp;winnings. Don&rsquo;t miss your chance - play AZ Fantasy 5 and check Arizona Fantasy 5 numbers online.</p>\n', '<h2>Playing The Lottery</h2>\n\n<p style=\"text-align:justify\">To play AZ Fantasy 5, you will need the lottery ticket. Find the nearest lotto retailers to purchase a lottery ticket every day between 4 AM and 12 AM. Importantly, the lottery ticket sales are closed at 9:30 right before Arizona Fantasy 5 results are published.&nbsp;<br />\nThe players are supposed to match as many winning numbers as possible. It all works as follows:</p>\n\n<p style=\"text-align:justify\">&nbsp;</p>\n\n<table align=\"center\">\n	<tbody>\n		<tr>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MATCH&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp;PRIZE&nbsp; &nbsp;</strong></span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp; &nbsp;ODDS IN 1&nbsp; &nbsp; &nbsp;</strong></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp;4 numbers&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;JACKPOT&nbsp; &nbsp;&nbsp;</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">749.398</span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">3 numbers</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$500</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">4.163</span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">2 numbers</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$5</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">119</span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1 number</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$1</span></span></p>\n			</td>\n			<td>\n			<p dir=\"ltr\" style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">11</span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p>In the evening, when Arizona Fantasy 5 latest winning numbers are, finally, aired on NBC, the players are to check whether they have the matches. For the sake of the players&#39; comfort, AZ latest Fantasy 5 winning numbers can be found on the Internet as well. Check our website, to be kept up-to-date on Arizona Fantasy 5 results.</p>\n\n<p style=\"text-align:justify\">As you start to play AZ Fantasy 5, make sure to check whether you have a special sign on your ticket called &ldquo;doubler.&rdquo; The symbol means that all the non-jackpot prizes are doubled.</p>\n\n<p style=\"text-align:justify\">Use &ldquo;Extra&rdquo; option to win even more! &ldquo;Extra&rdquo; can be bought per $1 or $2 giving a chance to win up to $250 or $500 respectfully. The point here is to match your numbers with AZ latest Fantasy 5 winning numbers. Naturally, if you have more than one match with the results, you win more prizes for every new match as well.</p>\n\n<h3>Latest&nbsp;Results</h3>\n\n<p style=\"text-align:justify\">The lotto game gained its popularity as it allows the players to win starting from 5 and up to 50 000 dollars. Play the lottery six evenings a week (Monday-Saturday) to hit the jackpot. The results are announced on NBC channel 12 at the end of the day at 10:25 PM.&nbsp;</p>\n\n<h3>Winning Odds</h3>\n\n<p style=\"text-align:justify\">Ex-Pick 5 lotto game is not that hard to play. There are two ways to play it, in fact: you can either pick 5 numbers from 1 to 41 or choose a quick pick meaning that the computer picks the numbers for you. Note that you can, actually, play your Arizona Fantasy 5 numbers during the next 12 drawing dates. In other, words, the players can use the same ticket for up to 12 consecutive days. The only thing to do is to either put a corresponding mark in the &ldquo;Number of Draws&rdquo; box or to inform the retailer while buying a ticket.<br />\nWhat are the chances to hit the jackpot with Fantasy 5? In general, the odds of winning any prize are 1:72 which is not bad. Sure, the more matches the players have while checking Arizona Fantasy 5 results, the better for them. Here, how it works:<br />\n&nbsp;</p>\n\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">2 matches</span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">$ 1</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">3 matches</span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">$ 5</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">4 matches</span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">$ 50</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">5 matches</span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:18px\">$ 50 000</span></td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"text-align:justify\">&nbsp;</p>\n\n<p style=\"text-align:justify\">Starting from the moment the results are published, the players have 180 days to claim Arizona Fantasy Five&nbsp;winnings and enjoy their victory to the full.</p>\n\n<h4>Record Jackpots</h4>\n\n<p style=\"text-align:justify\">One of the reasons to play AZ Fantasy 5 is the fact that the largest and comparatively recent jackpot was hit on July 10, 2010, and comprised $667,000. As for the record prize, it comprises $729,505; no one beat the record jackpot since 1992.</p>\n\n<h4>Claiming Your Winnings</h4>\n\n<p style=\"text-align:justify\">As you checked Arizona Fantasy 5 latest winning numbers and understand that you have some matches, there arises the question regarding claiming the winning. If your prize is up to $100, any AZ lotto distributor can redeem the cash prize, if your winning is up to $599, not all the retailers will redeem your winning but only some of them. In case if you win $600 and more, claim your Arizona Fantasy Five winnings at the Arizona Lottery office.</p>\n', '0', '1', '0', '128', '0', '0', '0', '0', '0', '1', '0', '0', '2018-12-27 13:25:17'
// таблица Pages лишняя запись с одним и тем же is_lottery и id_languages.  page_id - '6137', 'LottoPage', 'AZ Pick 3 Results - Check Latest Winning Numbers', '', '', 'az pick 3 results,play az pick 3,az pick three,arizona pick 3 numbers,arizona pick 3 winning numbers,az latest pick 3 winning numbers,claim pick 3 winnings az', 'Localotto offers you AZ Pick 3 results online. Join the luckies who already won stunning jackpots. Here, you will find out when to look for AZ latest Pick 3 winning numbers and how to claim Pick 3 winnings AZ.', '', '', '<h1>AZ Pick 3 Results</h1>\n\n<p style=\"text-align:justify\">AZ Pick Three is a popular 3-digit numbers lotto game. The players can find AZ Pick 3 results on our website right after the moment of their publishment. Additionally, Localotto offers some other worthy information about the game. Play AZ Pick 3 with us and match your Arizona Pick 3 numbers with the recent results available online.</p>\n', '<h2>Playing The Lottery</h2>\n\n<p style=\"text-align:justify\">Before you start to play AZ Pick 3, you should know that the cost of a lottery ticket determines the possible top prize. In such a way, having a $1 ticket - the player may win up to $500, while the 5 cents ticket can bring $250.<br />\nNotably, the drawing days are every day except of Sunday at 7 PM. Keep in mind that from November till March, the drawing time shifts back to 8 AM. Az Pick 3 results are defined by the computer random number generator. Thus, you have an opportunity to play AZ Pick 3 almost everyday and get the most precise Arizona Pick 3 winning numbers the same day.</p>\n\n<h3>Winning Odds</h3>\n\n<p style=\"text-align:justify\">AZ Pick Three is played the following way: first, you are to choose a 3-digit combination using the numbers from 000 up to 999. The next thing to do is to decide on the way you are eager to play the lotto game. All in all, there are five play types:</p>\n\n<p style=\"text-align:justify\">&nbsp;</p>\n\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\">&nbsp;</span><span style=\"font-family:arial,helvetica,sans-serif\"><strong> &nbsp;Straight&nbsp; &nbsp;</strong></span></td>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;all the three numbers are drawn in the exact order</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp;<strong> &nbsp;Box&nbsp; &nbsp;</strong></span></td>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;numbers are drawn in any order. There are two options in Box type - 3-way (two out of three numbers of the player are the same) and 6-way (three different numbers are chosen)</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp; <strong>&nbsp;Straight/Box&nbsp;</strong> &nbsp;</span></td>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;all the three numbers are drawn either in exact or any order</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp;Front Pair&nbsp; </strong>&nbsp;</span></td>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;only first two numbers are drawn in exact order</span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;<strong>Back Pair&nbsp; </strong>&nbsp;</span></td>\n			<td style=\"text-align:center\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;only last two numbers are drawn in exact order</span></td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p style=\"text-align:justify\">To play AZ Pick 3, you should first understand your winning odds as these are different for different play types. Here, what chances you have playing&nbsp;Pick Three:</p>\n\n<p style=\"text-align:justify\">&nbsp;</p>\n\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>Play type</strong></span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp; Odds&nbsp;&nbsp;</strong></span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>&nbsp; &nbsp;$1 Ticket&nbsp; &nbsp;</strong></span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>$ 0.5 Ticket&nbsp;&nbsp;</strong></span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Straight (Exact)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:1.000</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$ 250</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$ 500</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Box Any (3-way)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:333</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$80</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$160</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Box Any (6-way)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:167</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$40</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$80</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Straight/Box 3-way (Straight)&nbsp; &nbsp;</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:1.000</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$165</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$330</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Straight/Box 3-way (Box)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:333</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$40</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$80</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Straight/Box 6-way (Straight)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:1.000</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$145</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$290</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Straight/Box 6-way (Box)</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:167</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$20</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$40</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Front Pair</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:100</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$25</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$50</span></span></td>\n		</tr>\n		<tr>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Back Pair</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">1:100</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$25</span></span></td>\n			<td style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">$50</span></span></td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p style=\"text-align:justify\">Just as in case with Fantasy 5 lottery, the players can play Arizona Pick 3 numbers for up to 12 consecutive times using the same ticket.</p>\n\n<h4>How to Claim Your Winnings</h4>\n\n<p style=\"text-align:justify\">The first things to do after you checked AZ pick 3 Results is to gain your prizes. So, what should you do to claim Pick 3 winnings AZ? Normally, the lottery distributors redeem the winnings up to $100 and, in some cases, up to $599. If AZ latest Pick 3 winning numbers show that your winnings is even bigger - refer to Arizona Lottery office to claim claim pick 3 winnings AZ.</p>\n', '0', '1', '0', '129', '0', '0', '0', '0', '0', '1', '0', '0', '2018-12-27 13:23:49'
// таблица broker-phones страны с таким id нету
//  id, broker_id, country_id, phone
// '758', '60', '59', '8 (017) 288-20-5'
// '759', '60', '59', '8 (029) 388-20-5'
// '60', 'Superloto', 'http://superloto.by/en/', '0', '0', '0', '0', '0', '265000', '2005', '0', '0', '0', '0', '0', '0', '0', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0'
//-----------------------


        $migrationModel = new MigrateOldData();
        /*$migrationModel->migratePaymentMethods();
        echo '<p>Migrated. migratePaymentMethods</p>';
        $migrationModel->migrateLanguages();
        echo '<p>Migrated Languages</p>';
        $migrationModel->migrateCurrencies();
        echo '<p>Migrated. migrateCurrencies</p>';
        $migrationModel->migrateCountries();
        echo '<p>Migrated. migrateCountries</p>';
        $migrationModel->migrateLotteries();
        echo '<p>Migrated. migrateLotteries</p>';
        $migrationModel->migrateBrokerStatuses();
        echo '<p>Migrated migrateBrokerStatuses</p>';
        $migrationModel->migrateBrokers();
        echo '<p>Migrated. migrateBrokers</p>';
        $migrationModel->migratePages();
        echo '<p>Migrated Pages</p>';
        $migrationModel->migrateBanners();
        echo '<p>Migrated Banners</p>';
        $migrationModel->migrateBonuses();
        echo '<p>Migrated migrateBonuses</p>';
        $migrationModel->migrateBrokerEmails();
        echo '<p>Migrated migrateBrokerEmails</p>';
        $migrationModel->migrateBrokerLanguages();
        echo '<p>Migrated migrateBrokerLanguages</p>';
        $migrationModel->migrateBrokerLanguagePositions();
        echo '<p>Migrated migrateBrokerLanguagePositions</p>';
        $migrationModel->migrateLotteryLanguagePositions();
        echo '<p>Migrated migrateLotteryLanguagePositions</p>';
        $migrationModel->migrateBrokerPaymentMethods();
        echo '<p>Migrated migrateBrokerPaymentMethods</p>';
        $migrationModel->migrateBrokerPhone();
        echo '<p>Migrated migrateBrokerPhone</p>';
        $migrationModel->migrateBrokerToLottery();
        echo '<p>Migrated migrateBrokerToLottery</p>';
        $migrationModel->migrateContactMessages();
        echo '<p>Migrated migrateContactMessages</p>';
        $migrationModel->migrateSubscribe();
        echo '<p>Migrated migrateSubscribe</p>';
        $migrationModel->migrateSitemapChanges();
        echo '<p>Migrated migrateSitemapChanges</p>';
        $migrationModel->migrateSitemapSettings();
        echo '<p>Migrated migrateSitemapSettings</p>';
        $migrationModel->migrateSlider();
        echo '<p>Migrated migrateSlider</p>';
        $migrationModel->migrateI18n();
        echo '<p>Migrated migrateI18n</p>';*/

        $migrationModel->migrateLotteryResult();
        echo '<p>Migrated migrateLotteryResult</p>';

        /** time counting finished */
        $time_end = microtime(true);
        $execString = "<br>Execution time: " . round(($time_end - $time_start), 4) . " ms. \n <br>";
        echo $execString;
    }

    public function actionPm()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migratePaymentMethods();
        echo 'Migrated. migratePaymentMethods';
    }

    public function actionCurrencies()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateCurrencies();
        echo 'Migrated. migrateCurrencies';
    }

    public function actionCountries()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateCountries();
        echo 'Migrated. migrateCountries';
    }

    public function actionLotteries()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateLotteries();
        echo 'Migrated. migrateLotteries';
    }

    public function actionLotteryTimers()
    {
        // Or maybe get from minilotto
    }

    public function actionLotteryResults()
    {

    }

    public function actionBrokers()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokers();
        echo 'Migrated. migrateBrokers';
    }

    public function actionBrokerStatuses()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerStatuses();
        echo 'Migrated migrateBrokerStatuses';
    }

    public function actionLanguages()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateLanguages();
        echo 'Migrated Languages';
    }

    public function actionPages()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migratePages();
        echo 'Migrated Pages';
    }

    public function actionBanners()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBanners();
        echo 'Migrated Banners';
    }

    public function actionBonuses()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBonuses();
        echo 'Migrated migrateBonuses';
    }

    public function actionBrokerEmails()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerEmails();
        echo 'Migrated migrateBrokerEmails';
    }

    public function actionBrokerLanguages()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerLanguages();
        echo 'Migrated migrateBrokerLanguages';
    }

    public function actionBrokerPositions()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerLanguagePositions();
        echo 'Migrated migrateBrokerLanguagePositions';
    }

    public function actionLotteryPositions()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateLotteryLanguagePositions();
        echo 'Migrated migrateLotteryLanguagePositions';
    }

    public function actionBrokerPaymentMethods()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerPaymentMethods();
        echo 'Migrated migrateBrokerPaymentMethods';
    }

    public function actionBrokerPhone()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerPhone();
        echo 'Migrated migrateBrokerPhone';
    }

    public function actionBrokerLottery()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateBrokerToLottery();
        echo 'Migrated migrateBrokerToLottery';
    }

    public function actionContactMessages()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateContactMessages();
        echo 'Migrated migrateContactMessages';
    }

    public function actionSubscribe()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateSubscribe();
        echo 'Migrated migrateSubscribe';
    }

    public function actionSitemapChanges()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateSitemapChanges();
        echo 'Migrated migrateSitemapChanges';
    }

    public function actionSitemapSettings()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateSitemapSettings();
        echo 'Migrated migrateSitemapSettings';
    }

    public function actionSlider()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateSlider();
        echo 'Migrated migrateSlider';
    }

    public function actionI18n()
    {
        $migrationModel = new MigrateOldData();
        $migrationModel->migrateI18n();
        echo 'Migrated migrateI18n';
    }
}