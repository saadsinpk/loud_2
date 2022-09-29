<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



            
User::create( [
'id'=>5,
'name'=>'mail name',
'email'=>'mailname@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$XiRI6AyQl1MnS./YSx5./uF9TL1L6iT3Zxg3hNPq9T1.7NS5MGrf6',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>'',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-06 10:56:05',
'updated_at'=>'2022-07-06 10:56:05'
] );


            
User::create( [
'id'=>6,
'name'=>'New User',
'email'=>'new_user@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$huliER4Lb8kQCdqhqVIK/eblbG6rjlCHh5F3ioUWLNo8M8Ox09Qx6',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>'',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-06 11:17:46',
'updated_at'=>'2022-07-06 11:17:46'
] );


            
User::create( [
'id'=>9,
'name'=>'Muhammad Saad',
'email'=>'saad@sidtechno.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$W094GGfEr58m6kTeP1zxF.B8eSDFhynBlNkTPr0t/k6ox8.cldjca',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>'',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-08 09:52:20',
'updated_at'=>'2022-07-08 09:53:23'
] );


            
User::create( [
'id'=>10,
'name'=>'Muhammad',
'email'=>'saad@mail2.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$qEoSJ4A.Sd4QX3Aq0ddwCuflLfK5RW07q7s4GUNyfhfpmxSxiaeBq',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>'',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-08 09:57:25',
'updated_at'=>'2022-07-13 07:37:07'
] );


            
User::create( [
'id'=>11,
'name'=>'Muhamamd Saad...',
'email'=>'mail1test@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$5KnuyobTr9vd9nJYbm/Jc.fcImAhYJQ81wipfnPsvy/Lu97AjaS6O',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>'',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-14 10:51:43',
'updated_at'=>'2022-07-14 10:51:43'
] );


            
User::create( [
'id'=>17,
'name'=>'Muhamamd Saad...',
'email'=>'saad_sinpk@yahoo.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$TjH3xZw9FGNK.zUkf9go0OjgcRJwh/vOGGBPk6eiwwZbyJ7OQon6K',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>'5230',
'otp_sent_on'=>'2022-09-08 12:05:13',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-14 11:12:50',
'updated_at'=>'2022-09-08 14:01:10'
] );


            
User::create( [
'id'=>18,
'name'=>'Muhmamd',
'email'=>'mail@mail2.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$EJqsniN5t/vNo0KhjaEdzePjGQJsFrRKib.RVrRrkLf78017UMyC2',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:27:48',
'updated_at'=>'2022-07-18 13:27:48'
] );


            
User::create( [
'id'=>19,
'name'=>'Muhmamd',
'email'=>'mail@mail4.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$KkdPQxA6xkqZ33/tlujb0OfqgGnZL39PYarJxIoEvYmsDfWfV3If2',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:34:09',
'updated_at'=>'2022-07-18 13:34:09'
] );


            
User::create( [
'id'=>20,
'name'=>'Muhmamd',
'email'=>'mail@mail5.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$uOFzI3x6lZmQ3wzUHq9gHObnJ7r5EZ7EJjjhyOg7.AdWFB1b2ADTC',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:42:21',
'updated_at'=>'2022-07-18 13:42:21'
] );


            
User::create( [
'id'=>21,
'name'=>'Muhmamd',
'email'=>'mail@mail6.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$phPIDmgq6vKTUU3n1vtw.e2U/eYZ4mClfG1FvbF9HaFJKFcjsABTK',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:48:00',
'updated_at'=>'2022-07-18 13:48:00'
] );


            
User::create( [
'id'=>22,
'name'=>'Muhmamd',
'email'=>'mail@mail7.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$VXyk9bxKQ.l6KjWnK0i54./pLwdEi9Flqcu.cTdwh.hBSCOFHyxgu',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:48:54',
'updated_at'=>'2022-07-18 13:48:54'
] );


            
User::create( [
'id'=>23,
'name'=>'Muhmamd',
'email'=>'mail@mail8.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$9tAwt98Yas7JA/mW8bCn8.Jo3O5Bbo4BLyTCbL0jZwDqFBKOsTL.S',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:49:41',
'updated_at'=>'2022-07-18 13:49:41'
] );


            
User::create( [
'id'=>24,
'name'=>'Muhmamd',
'email'=>'mail@mail9.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$ayGcbCOt/k2lbD6jYI7r2e9Hgz8eVN8/TNl3ASSz1iJAjTEpVKeWu',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:50:42',
'updated_at'=>'2022-07-18 13:50:42'
] );


            
User::create( [
'id'=>25,
'name'=>'Muhmamd',
'email'=>'mail@mail10.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$YfZVxQTAB0w0mXRvDHqIn.Kp65HqRIpfHnsV8wxuNa7LBGsx51PF6',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>'facebook',
'provider_id'=>'1234',
'firebase_token'=>NULL,
'created_at'=>'2022-07-18 13:57:03',
'updated_at'=>'2022-07-18 13:57:03'
] );


            
User::create( [
'id'=>26,
'name'=>'Ann Akude',
'email'=>'akudrre@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$RsYJ9y84sJTruga5LQGEMeBJQ8DeexNRxcz7c9tYep7M/NqjzFmoW',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>'123',
'created_at'=>'2022-07-21 18:07:33',
'updated_at'=>'2022-08-20 13:26:31'
] );


            
User::create( [
'id'=>27,
'name'=>'Codepro',
'email'=>'paulodhiambo962@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$z/6wNooGDjMxDdGMeeStdOFFXlUmrkaKNxmFqGntPxSzWMlX.dOj.',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-08-20 15:16:48',
'updated_at'=>'2022-08-20 15:17:30'
] );


            
User::create( [
'id'=>28,
'name'=>'Jackson',
'email'=>'jackson@gmail.com',
'email_verified_at'=>NULL,
'password'=>'jackson@123',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-08-22 08:55:35',
'updated_at'=>'2022-08-22 09:40:37'
] );


            
User::create( [
'id'=>29,
'name'=>'Kristen Hampton',
'email'=>'kristenhampton.81372@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$m6i3aSpy9585s33QP6d72.IMAC4yBytqbcG/DUD4sEYhRgLIlX29i',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-08-25 14:00:38',
'updated_at'=>'2022-08-25 14:00:38'
] );


            
User::create( [
'id'=>30,
'name'=>'Kirti Chavda',
'email'=>'kirti301290@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$tMaOAv5eLiWeBJjVVgOjxOt1AJCDDYEiLdVlGWrp7gEgK43EJjQ1W',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-08-25 17:17:43',
'updated_at'=>'2022-09-06 14:02:21'
] );


            
User::create( [
'id'=>31,
'name'=>'Muhammad Saad',
'email'=>'saad.sid0@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$Om95Anu/aN/GA1GHArFtQuigEbV1erIX5FOH.bGHlHdk9bLNoMpd6',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-08-29 04:57:08',
'updated_at'=>'2022-09-06 13:30:41'
] );


            
User::create( [
'id'=>32,
'name'=>'Muhammad Saad',
'email'=>'new_user44@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$FsYxNpcr0jGWmrSNKeUcm.k8fK4Ykad1Mqu5mSPvnXkSLDtcpPLZy',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-09-07 09:51:31',
'updated_at'=>'2022-09-07 09:51:31'
] );


            
User::create( [
'id'=>33,
'name'=>'Muhammad Saad',
'email'=>'New_test_user344@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$OTMf.HJymgPFmWjTWBLw1.IZvnLHMAjJIImPbq/ucY/lb8fpY8/0.',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-09-07 09:53:25',
'updated_at'=>'2022-09-07 09:53:25'
] );


            
User::create( [
'id'=>34,
'name'=>'Test',
'email'=>'test@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$TEwF3ZuE/3bAJClkcuEVCeQ7CwtqaImkWDy695NCqVrie49..rxQC',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-09-08 14:25:20',
'updated_at'=>'2022-09-08 14:25:20'
] );


            
User::create( [
'id'=>35,
'name'=>'Ward Role 2',
'email'=>'ward_role_2@mail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$ckXKTtk0d4mSHbnWl6F9iunoaM7LUPl24ZEaw.CHn1w3dlXG9LTIy',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>NULL,
'otp_sent_on'=>NULL,
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-09-08 14:26:14',
'updated_at'=>'2022-09-08 14:26:14'
] );


            
User::create( [
'id'=>36,
'name'=>'Giddy Naya',
'email'=>'ogbonnagideon5@gmail.com',
'email_verified_at'=>NULL,
'password'=>'$2y$10$TR6VQc.ONToyPu5rM1uI/.kljDUaF5Q90SU6y5z1wYw3uKoLT0mmC',
'remember_token'=>NULL,
'profile_picture'=>NULL,
'otp'=>'7121',
'otp_sent_on'=>'2022-09-08 02:29:35',
'verify_token'=>NULL,
'verify'=>NULL,
'provider'=>NULL,
'provider_id'=>NULL,
'firebase_token'=>NULL,
'created_at'=>'2022-09-08 14:27:17',
'updated_at'=>'2022-09-08 15:25:02'
] );
   

$data = [ 
[
'id'=>1,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'6d05d665b5c4940a65d7f4c667abd69a7de49ac67ebc4e65523bd866f2fdf241',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 09:58:36',
'updated_at'=>'2022-07-08 09:58:36'
],
[
'id'=>2,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'272e604f6c214ef738981db9da0885d072a5b524f4ab0f67d53a4c1e400bb0dd',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 09:59:15',
'updated_at'=>'2022-07-08 09:59:15'
],
[
'id'=>3,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'3cacfa6835be1faa226437031aaeae0bff64003910a95a3d751ed453be753149',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 09:59:25',
'updated_at'=>'2022-07-08 09:59:25'
],
[
'id'=>4,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'e59f297c1b445fe48954f2d07e500eea87fddcbd3f3f3edd253667e0539401c4',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:00:03',
'updated_at'=>'2022-07-08 10:00:03'
],
[
'id'=>5,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'0803b8f0ad1160c3e179cc01ebedf748c9677f953d1a4c1305f79f0c6d7daa45',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:00:31',
'updated_at'=>'2022-07-08 10:00:31'
],
[
'id'=>6,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'9cc3106b418ab47a71a4fb1194dd78f0622b1a31c0c95131002cd4cdebb95f9a',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:00:42',
'updated_at'=>'2022-07-08 10:00:42'
],
[
'id'=>7,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'7a62b2da63bfa8bcecc44e7699ca5df76b1e30160cbb41755cce1b54df98aa7b',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:00:56',
'updated_at'=>'2022-07-08 10:00:56'
],
[
'id'=>8,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'e8e8fcc540b1eae843f299460f9aa6630c9aaf81e7b312de9006e248151f9d5b',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:01:07',
'updated_at'=>'2022-07-08 10:01:07'
],
[
'id'=>9,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'5210aebb2b4a2a3ff10566f21186575860bf9253bb098a1d8d30ac93f4062db9',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:01:20',
'updated_at'=>'2022-07-08 10:01:20'
],
[
'id'=>10,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'e0a6b55d5a3eebb7464e08d03d85d9d5e876bb25ab44709d2ecf4cdf041271b4',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:01:31',
'updated_at'=>'2022-07-08 10:01:31'
],
[
'id'=>11,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'f3f361751ac1e81feb61438eb7f241da5f3d23377be975c0938b421c860eec3e',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:01:35',
'updated_at'=>'2022-07-08 10:01:35'
],
[
'id'=>12,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'e852f64cf084d8e3ce00d4e1bf1d98e55f5314b1bd80f5d470acc26111f9d94f',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:04:39',
'updated_at'=>'2022-07-08 10:04:39'
],
[
'id'=>13,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'ad66ec3659bc390050190e348eca65ce6a1bad25735bc6cd1820ad550d2984e8',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:04:54',
'updated_at'=>'2022-07-08 10:04:54'
],
[
'id'=>14,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>9,
'name'=>'PersonalAccessToken',
'token'=>'91d0e2b162ef2966dd4e7aece33cd840b5172a5ae885cd57b207e1d13c30d117',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-08 10:05:10',
'updated_at'=>'2022-07-08 10:05:10'
],
[
'id'=>15,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>10,
'name'=>'PersonalAccessToken',
'token'=>'999be21059a07b45894ac13583eca03b09a8401bf678f6936aa57116e8751c57',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:37:31',
'updated_at'=>'2022-07-13 07:37:31'
],
[
'id'=>16,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>1,
'name'=>'PersonalAccessToken',
'token'=>'8899e599ccda2ff0fc7c33fa21281a2cce0bb9ee3ec44c5f474f092b648d40a6',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:37:47',
'updated_at'=>'2022-07-13 07:37:47'
],
[
'id'=>17,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>1,
'name'=>'PersonalAccessToken',
'token'=>'8964da39b17b50ac110b2678c50bf3086cefeb470449b1fc10aeb0d34134eefb',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:37:59',
'updated_at'=>'2022-07-13 07:37:59'
],
[
'id'=>18,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>1,
'name'=>'PersonalAccessToken',
'token'=>'57aa672bc010038ab245da69369c0d05ed3ab45cda98cecb00f3b6042a20e5f9',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:38:29',
'updated_at'=>'2022-07-13 07:38:29'
],
[
'id'=>19,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>1,
'name'=>'PersonalAccessToken',
'token'=>'2d636494d14e47735e2b97fc815ec2b2ef09e9e81617f0aa835314f69c96d722',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:39:53',
'updated_at'=>'2022-07-13 07:39:53'
],
[
'id'=>20,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>10,
'name'=>'PersonalAccessToken',
'token'=>'fd8bf40d6555bd6954710e027d0e7e50994b8c32b0bae5a11830f0e28c3966f8',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:40:02',
'updated_at'=>'2022-07-13 07:40:02'
],
[
'id'=>21,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>10,
'name'=>'PersonalAccessToken',
'token'=>'69be008448648bfda29c0302ada6e7573ffd1b6bd65223391f6273e1c10da956',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:40:48',
'updated_at'=>'2022-07-13 07:40:48'
],
[
'id'=>22,
'tokenable_type'=>'App\\Models\\User',
'tokenable_id'=>10,
'name'=>'PersonalAccessToken',
'token'=>'38c1c279982868a00e20690771c8862551fdc1ead9ccada313d76b505fb670b3',
'abilities'=>'[\"*\"]',
'last_used_at'=>NULL,
'created_at'=>'2022-07-13 07:41:17',
'updated_at'=>'2022-07-13 07:41:17'
]
];
        \DB::table('personal_access_tokens')->truncate();
        \DB::table('personal_access_tokens')->insert($data);
     }
}
