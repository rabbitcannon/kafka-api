/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('service-results', require('./components/services/Alerts.vue'));
Vue.component('kafka-topics', require('./components/topics/KafkaTopics.vue'));
Vue.component('subscription-list', require('./components/subscriptions/ListCurrent.vue'));
Vue.component('profile-view', require('./components/profile/ProfileView.vue'));

const app = new Vue({
    el: '#app',
});

/**
 * Footer Script
 */
$(window).on('load', function() {
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('div#app').css('display', 'block');
    $('body').delay(350).css({'overflow':'visible'});
});