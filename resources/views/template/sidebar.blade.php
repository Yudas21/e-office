        <!-- Left Sidebar  -->
        <div class="left-sidebar" style="background: #ff4100;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background: #ff4100;">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label" style="color: #fff;">Menu</li>
                        <?php $parent = Techmil::get_parent(); ?>
                        <?php $mymenu = array(); $mymenu = Techmil::get_mymenu(session('level')); ?>
                        @foreach ($parent as $mp)
                            @if (in_array($mp->id, $mymenu))
                                <?php $nc = Techmil::get_count_child($mp->id); ?>
                                @if ($nc > 0)
                                  <li> <a class="has-arrow" href="#" aria-expanded="false" style="color: #fff;"><i class="{{ $mp->icon }}" style="color: #fff;"></i><span class="hide-menu">{{ $mp->name }}</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php $child = Techmil::get_child($mp->id); ?>
                                        @foreach ($child as $mc)
                                           @if (in_array($mc->id, $mymenu))
                                              <li><a href="{{ url($mc->url) }}" style="color: #fff;">{{ $mc->name }}</a></li>
                                           @endif
                                        @endforeach
                                    </ul>
                                  </li>
                                @else
                                  <li> <a href="{{ $mp->url }}" aria-expanded="false" style="color: #fff;"><i class="{{ $mp->icon }}" style="color: #fff;"></i><span class="hide-menu">{{ $mp->name }}</span></a></li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->