<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

require_once(__DIR__ . '/../php/env.php');

/** Endereço do WordPress (URL) */
define('WP_SITEURL', 'https://portal.extensao.ufrj.br/formularios/');

/** Endereço do site (URL) */
define('WP_HOME', 'https://portal.extensao.ufrj.br/formularios/');

$_SERVER['HTTPS']='on';

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'xyVsWXA?^Gm*@zCWDP^*ma6|D$X/FDLYqS#ulebsmp4Xqlq++i-=>qb&zM/w-<L1' );
define( 'SECURE_AUTH_KEY',  'RW||JY&J!JN2jE5^)SNBt+yy!x]9|?1p!#@Kz6XJe0Jp$8{cUAb@.!vpdI&Q<nWX' );
define( 'LOGGED_IN_KEY',    '<0^SJ.b@}$@pVanO]ef ,sO%qV^X8[GEE(xz,`$J%N/WG%,s*y:$8FN3Ck%V#,M,' );
define( 'NONCE_KEY',        ']G-Y)(>.-%PGl->CgIxhN6Y*Z*u/@M4,&cNe7t*Y9w2*MgLn3GZf/+_*lf,b#j.H' );
define( 'AUTH_SALT',        'ezkTW&()XDkgj/=/G3r?92U/-WP>QEVfC3|%f5Vqu  xNI|TCGit40 cdCr^<SKv' );
define( 'SECURE_AUTH_SALT', 'RBA`,0Gb5+;(M(gRtcF{7tN{Q:ZoHKM}1Ch|`[b =uwAJ8B,6XG.:)yWUj[n2CZy' );
define( 'LOGGED_IN_SALT',   'ZA6m:Y}WZuHD|R_5cTCE3)0~dz%mO+8`>2)veCZ~n0<!G18~)&v^_4|4PEhLG >R' );
define( 'NONCE_SALT',       'X|6#aw%Jsp^Pw7l|?Jaz,[/iI&bd&sdidgNJid[B|CA^ovL$4ToRwj<vV;jvYP?r' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
