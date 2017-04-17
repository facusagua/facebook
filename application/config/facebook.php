<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook_app_id']              = '301085880304409';
$config['facebook_app_secret']          = 'd1c1a7331a69717f1ead5d21dee9f829';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'profile';
$config['facebook_logout_redirect_url'] = 'profile/logout';
$config['facebook_permissions']         = array('public_profile','email','user_friends','user_about_me','user_actions.books','user_about_me','user_likes','user_birthday','user_education_history','user_events','user_games_activity','user_hometown','user_likes','user_location','user_managed_groups','user_photos','user_posts','user_relationships','user_relationship_details','user_religion_politics','user_tagged_places','user_videos','user_website','user_work_history','read_custom_friendlists','read_insights','read_audience_network_insights','read_page_mailboxes','manage_pages','publish_pages','publish_actions','rsvp_event','pages_show_list','pages_manage_cta','pages_manage_instant_articles','ads_read','ads_management','business_management','pages_messaging','pages_messaging_subscriptions','pages_messaging_phone_number');
$config['facebook_graph_version']       = 'v2.8';
$config['facebook_auth_on_load']        = TRUE;
