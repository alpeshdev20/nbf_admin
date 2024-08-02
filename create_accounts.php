<?php

$accounts = [

	['user'=>'nbftest1@nbf.com','password'=>'$2y$10$LXOt0mTW4aJ6lhKTsJINyOLbA6srwZZaGcgiS4q9HElqkRCdvhm2u'],
	['user'=>'nbftest2@nbf.com','password'=>'$2y$10$l8J6.rEF8bysHKWY.XzasuLSuwrufvUYHsIMdca5eIHSdafIPdn26'],
	['user'=>'nbftest3@nbf.com','password'=>'$2y$10$5WClIL1lbJ9flZjd30omLOwm1LEDOgTkzsv4Rj/2m9iLRyxkT3ALq'],
	['user'=>'nbftest4@nbf.com','password'=>'$2y$10$d4Yiwd6CEE2yOfVbhCgaRuk29SLJh239a6XXQxoG.IBVIqZnwCc2.'],
	['user'=>'nbftest5@nbf.com','password'=>'$2y$10$w/WIru7tN3oXe4N.kxBFuOYgKa9aiXOHRRbKIqwxccA76L7f4r.g.'],
	['user'=>'nbfuser@nbf.com','password'=>'$2y$10$EEqmTLDFREJ8NFUqLOQShu2f0qwGDeqgLlpcgwQawqcrI7JW59kCy']

];

/*

  "nbf1@2022" => "$2y$10$LXOt0mTW4aJ6lhKTsJINyOLbA6srwZZaGcgiS4q9HElqkRCdvhm2u"
  "nbf2@2022" => "$2y$10$l8J6.rEF8bysHKWY.XzasuLSuwrufvUYHsIMdca5eIHSdafIPdn26"
  "nbf3@2022" => "$2y$10$5WClIL1lbJ9flZjd30omLOwm1LEDOgTkzsv4Rj/2m9iLRyxkT3ALq"
  "nbf4@2022" => "$2y$10$d4Yiwd6CEE2yOfVbhCgaRuk29SLJh239a6XXQxoG.IBVIqZnwCc2."
  "nbf5@2022" => "$2y$10$w/WIru7tN3oXe4N.kxBFuOYgKa9aiXOHRRbKIqwxccA76L7f4r.g."
  "nbfuser@2022" => "$2y$10$EEqmTLDFREJ8NFUqLOQShu2f0qwGDeqgLlpcgwQawqcrI7JW59kCy"
  
  
  
  user id: nbftest1@nbf.com 
  pass: nbf1@2022
  
  user id: nbftest2@nbf.com
  pass: nbf2@2022
  
  user id: nbftest3@nbf.com
  pass: nbf3@2022
  
  user id: nbftest4@nbf.com
  pass: nbf4@2022
  
  user id: nbftest5@nbf.com
  pass: nbf5@2022
  
  user id: nbfuser@nbf.com
  pass: nbfuser@2022

  
*/


$conn = mysqli_connect('localhost','root', '', 'ebook');
if(!$conn)die(mysqli_connect_error());


foreach($accounts as $account){
	mysqli_query($conn, "INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account', '{$account['user']}', '{$account['password']}', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());");
	
	mysqli_query($conn, "INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('Test Plan', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 100, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());");
}

die();

$query = "INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('Test Plan', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 100, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());";






/*

INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account 1', 'nbftest1@nbf.com', '$2y$10$LXOt0mTW4aJ6lhKTsJINyOLbA6srwZZaGcgiS4q9HElqkRCdvhm2u', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('Test Plan', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 100, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());



INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account 2', 'nbftest2@nbf.com', '$2y$10$l8J6.rEF8bysHKWY.XzasuLSuwrufvUYHsIMdca5eIHSdafIPdn26', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('BOOK PLUS Annual Package', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 8, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());



INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account 3', 'nbftest3@nbf.com', '$2y$10$5WClIL1lbJ9flZjd30omLOwm1LEDOgTkzsv4Rj/2m9iLRyxkT3ALq', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('BOOK PLUS Annual Package', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 8, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());

INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account 4', 'nbftest4@nbf.com', '$2y$10$d4Yiwd6CEE2yOfVbhCgaRuk29SLJh239a6XXQxoG.IBVIqZnwCc2.', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('BOOK PLUS Annual Package', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 8, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());

INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account 5', 'nbftest5@nbf.com', '$2y$10$w/WIru7tN3oXe4N.kxBFuOYgKa9aiXOHRRbKIqwxccA76L7f4r.g.', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('BOOK PLUS Annual Package', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 8, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());

INSERT INTO u_logins (name, email, password, mobile, created_at, updated_at) VALUES ('NBF Test Account', 'nbfuser@nbf.com', '$2y$10$EEqmTLDFREJ8NFUqLOQShu2f0qwGDeqgLlpcgwQawqcrI7JW59kCy', 0000000000, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
INSERT INTO subscribers (plan_name, plan_end_date, user_id, subscription_id, auto_renew, status, created_at, updated_at) VALUES ('BOOK PLUS Annual Package', DATE_ADD(CURDATE(), INTERVAL 5 YEAR), (SELECT LAST_INSERT_ID()), 8, 1, 1, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());



*/


















?>