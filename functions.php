<?php
/**
 * Retourne vrai si l'alias correspond à home
 * @return bool
 */
function isHome($alias){
  return $alias == 'home';
}
/**
 * Retourne l'alias de la page selon l'url
 * @param string $alias url
 * @return string joomla page alias
 */
function getAlias($alias){
  if (strpos($alias, '.html')) {
    $alias = substr($alias, strrpos($alias, '/') + 1);
    $alias = str_replace('.html', '', $alias);
  } else {
    $alias = str_replace('/', '', $alias);
  }
  return $alias != '' ? strtolower($alias) : 'home';
}
/**
 * Retourne un tableau contenant les alias de la section et de la catégorie.
 * @param JFactory db $db 
 * @return array 
 */
function getAliases($db){
  if ($_GET['view'] == 'article') {
    $query = "SELECT `jos_categories`.alias AS catName, `jos_categories`.title AS catTitle, `jos_sections`.alias AS sectionName
    FROM `jos_content`
    INNER JOIN `jos_categories` ON `jos_content`.catid = `jos_categories`.id
    INNER JOIN `jos_sections` ON `jos_content`.sectionid = `jos_sections`.id
    WHERE `jos_content`.`id` =" . $_GET['id'];
  } else if ($_GET['view'] == 'category') {
    $query = "SELECT `jos_categories`.alias AS catName, `jos_sections`.alias AS sectionName
    FROM `jos_categories`
    INNER JOIN `jos_sections` ON `jos_categories`.section = `jos_sections`.id
    WHERE `jos_categories`.`id` =" . $_GET['id'];
  }
  $db->setQuery($query);
  $result = $db->query();
  $row = $db->loadAssocList();
  return $row[0];
}
/**
 * Retourne l'alias de la catégorie selon le résultat de la fonction getAliases
 *
 * @param array $aliases Résustat de la fonction getAliases
 * @return string catAlias
 */
function getCatAlias($aliases){
  return $aliases['catName'];
}
/**
 * Retourne l'alias de la catégorie selon le résultat de la fonction getAliases
 *
 * @param array $aliases Résustat de la fonction getAliases
 * @return string catAlias
 */
function getSectionAlias($aliases){
  return $aliases['sectionName'];
} 
/**
 * Retourne une ressource XML à partir d'un fichier rss distant.
 * Le fichier est conservé en cache durant 15 minutes.
 * @param string $externalUrl Url du xml distant
 * @param string $localPath Path du fichier cache sur le serveur
 * @param int $cacheTime Temps en millisecondes (15 minutes par défaut)
 */
function getCachedXml($externalUrl, $localPath, $cache_time = 900) {
  $cache_file = $localPath;
  $timedif = @(time() - filemtime($cache_file));

  if (file_exists($cache_file) && $timedif < $cache_time) {
    $string = file_get_contents($cache_file);
  } else {
    $string = file_get_contents($externalUrl);
    if ($f = @fopen($cache_file, 'w')) {
      fwrite($f, $string, strlen($string));
      fclose($f);
    }
  }
  return simplexml_load_string($string);  
}
/**
 * Retourne vrai si la description reçu est la description par défaut de joomla.
 * @param string $desc 
 * @return bool
 */
function isDefaultJoomlaDesc($desc){
  return $desc == 'Joomla! - the dynamic portal engine and content management system';
}
/**
 * Affiche les erreurs en mode déboguage
 * @param array $errors 
 */
function displayDebugErrors($errors) {
  echo implode('<br>', $errors);
}
/**
 * Print la variable sous forme visuellement lisible
 * @param mixed $var 
 */
function debug($var) {
  echo '<pre>';
  print_r($var);
  echo '</pre>';
}
/**
 * Détecte si le browser client est IE6
 * @return bool 
 */
function is_ie6() {
  return strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE;
}
/**
 * Détecte si le browser client est IE7
 * @return bool 
 */
function is_ie7() {
  return strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.') !== FALSE;
}
/**
 * Attention : Hardcoded. Retourne vrai si on est sur le serveur de dev de verteb
 * @return bool 
 */
function isDevAccount(){
  $array = split('/', $_SERVER['DOCUMENT_ROOT']);
  return $array[2] == 'sts01'; //Change for your own dev server name if you fork this file. Pattern for us is subdomain.sts01.com so feel free to completely edit/remove this function
}
?>
