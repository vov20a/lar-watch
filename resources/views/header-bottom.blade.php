<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="top-nav">
                    <div class="menu-container">
                        <div class="menu">
                            @include('layouts.partials.menu_ul')
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 header-right">
                <div class="search-bar">
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" id="autocomplete" name="search" value="Search a product..."
                            onfocus="this.value = '';"
                            onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
                        <input type="submit" value=" ">
                    </form>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--bottom-header-->
