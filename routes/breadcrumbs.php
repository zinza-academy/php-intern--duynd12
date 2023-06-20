<?php 

// use Diglactic\Breadcrumbs\Breadcrumbs;
// use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// // Home
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('home', route('/'));
// });

// // Home > Blog
// Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('setting', route('setting.store'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });