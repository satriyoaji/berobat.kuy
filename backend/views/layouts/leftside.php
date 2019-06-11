<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => '', 'options' => ['class' => 'header']],
                        ['label' => 'Home', 'icon' => 'fa fa-home', 
                            'url' => ['/'], 'active' => $this->context->route == 'site/index'
                        ],
                        [
                            'label' => 'Pasien',
                            'icon' => 'fa fa-user',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Users',
                                    'icon' => 'fa fa-user',
                                    'url' => '?r=users/index',
				                    'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Pendaftaran',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=pendaftaran/index',
				                    'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
                        [
                            'label' => 'Dokter',
                            'icon' => 'fa fa-user-md',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Jadwal Dokter',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=jadwal-dokter/index',
				                    'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Jenis Periksa',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=jenis-periksa/index',
				                    'active' => $this->context->route == 'master2/index'
                                ],
                                [
                                    'label' => 'Pemeriksaan',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=pemeriksaan/index',
				                    'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
                        [
                            'label' => 'Parmacy',
                            'icon' => 'fa fa-medkit',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' =>'Resep',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=resep/index',
				                    'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'detail Resep',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=jenis-periksa/index',
				                    'active' => $this->context->route == 'master2/index'
                                ],
                                [
                                    'label' => 'Obat',
                                    'icon' => 'fa fa-plus-square',
                                    'url' => '?r=obat/index',
				                    'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
                        [
                            'label' => 'Cashier',
                            'icon' => 'fa fa-cc-discover',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' =>'Resep',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=resep/index',
				                    'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'detail Resep',
                                    'icon' => 'fa fa-file',
                                    'url' => '?r=detail-resep/index',
				                    'active' => $this->context->route == 'master2/index'
                                ],
                            ]
                        ],
                        ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                        ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
