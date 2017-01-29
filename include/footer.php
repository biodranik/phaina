<footer>
  <p class="footer__copyright footer__copyright--separated">&copy; 2017 VibroBox OÜ</p>
  <?php foreach (MainMenu() as $m) : ?>
    <a class="footer__link" href="<?= $m->url ?>"><?= $m->title ?></a>
  <?php endforeach; ?>
</footer>
