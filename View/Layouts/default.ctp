<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?> @ 台南市議員觀測中心</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->meta(array('property' => 'og:image', 'content' => isset($img_for_layout) ? $img_for_layout : $this->Html->url('/img/og_image.png', true)));
        echo $this->Html->meta('description', isset($desc_for_layout) ? $desc_for_layout : '台南市議員觀測中心蒐集與整理議會與議員的相關資訊，透過更直覺的方式去呈現結果，讓大家可以更快找到想要了解的資訊');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('default');
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('olc');
        echo $this->Html->script('d3.v3.min');
        echo $scripts_for_layout;
        ?>
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo $this->Html->link('議員觀測中心', '/', array('class' => 'navbar-brand')); ?>
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">
                        <li><?php echo $this->Html->link('議員', '/parliamentarians'); ?></li>
                        <li><?php echo $this->Html->link('議案', '/motions'); ?></li>
                        <li><?php echo $this->Html->link('議案標籤雲', '/motions/terms'); ?></li>
                        <li><?php echo $this->Html->link('議員建議事項', '/grants'); ?></li>
                        <?php if ($this->Session->read('Auth.User.id')): ?>
                            <li><?php echo $this->Html->link('Parliamentarians', '/admin/parliamentarians'); ?></li>
                            <li><?php echo $this->Html->link('Parties', '/admin/parties'); ?></li>
                            <li><?php echo $this->Html->link('Motions', '/admin/motions'); ?></li>
                            <li><?php echo $this->Html->link('Areas', '/admin/areas'); ?></li>
                            <li><?php echo $this->Html->link('Terms', '/admin/terms'); ?></li>
                            <li><?php echo $this->Html->link('Members', '/admin/members'); ?></li>
                            <li><?php echo $this->Html->link('Groups', '/admin/groups'); ?></li>
                            <li><?php echo $this->Html->link('Logout', '/members/logout'); ?></li>
                        <?php endif; ?>
                        <?php
                        if (!empty($actions_for_layout)) {
                            foreach ($actions_for_layout as $title => $url) {
                                echo '<li>' . $this->Html->link($title, $url) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </nav>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <div id="viewContent"><?php echo $content_for_layout; ?></div>
        </div>
        <div id="footer" class="container">
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES * * */
                var disqus_shortname = 'tncc';
                var disqus_config = function () {
                    this.language = "zh_TW";
                };

                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function () {
                    var dsq = document.createElement('script');
                    dsq.type = 'text/javascript';
                    dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            --<br />
            <?php echo $this->Html->link('江明宗 . 政 . 路過', 'http://k.olc.tw/', array('target' => '_blank')); ?>
            <?php if (!$this->Session->read('Auth.User.id')): ?>
                / <?php echo $this->Html->link('Login', '/members/login'); ?>
            <?php endif; ?>
            <div id="fb-root"></div>
            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=1393405437614114&version=v2.3";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="col-md-6">
                <div class="fb-page" data-href="https://www.facebook.com/k.olc.tw" data-width="500" data-hide-cover="true" data-show-facepile="true" data-show-posts="false"></div>
            </div>
            <div class="col-md-6">
                <div class="fb-page" data-href="https://www.facebook.com/g0v.tw" data-width="500" data-hide-cover="true" data-show-facepile="true" data-show-posts="false"></div>
            </div>
        </div>
        <?php
        echo $this->element('sql_dump');
        ?>
        <script type="text/javascript">
            //<![CDATA[
            $(function () {
                $('a.dialogControl').click(function () {
                    dialogFull(this);
                    return false;
                });
            });
            //]]>
        </script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-51256613-1', 'auto');
            ga('send', 'pageview');
            ga('set', 'contentGroup2', 'tncc');

        </script>
    </body>
</html>