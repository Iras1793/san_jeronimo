<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Librería Crypto para CodeIgniter 3
 *
 * Cifrado  : AES-256-GCM (simétrico autenticado)
 * Formato  : base64( IV[12] + TAG[16] + CIPHERTEXT )
 * Uso      : $this->crypto->cifrar($dato)
 *            $this->crypto->descifrar($datoBase64)
 *            $this->crypto->hashPassword($pass)
 *            $this->crypto->verificarPassword($pass, $hash)
 */
class Crypto
{
    private const CIPHER  = 'aes-256-gcm';
    private const IV_LEN  = 12;
    private const TAG_LEN = 16;

    /** @var string */
    private $llave;

    public function __construct(){
        $CI =& get_instance();
        $CI->config->load('crypto', TRUE);

        $llave = base64_decode('QLuMErYNS+KrUYQjIS9ycevfqKtkrKdUivaFoGBONqM=');

        if (empty($llave) || mb_strlen($llave, '8bit') !== 32) {
            show_error('Crypto: llave inválida. Verifica APP_CRYPTO_KEY en tu .env', 500);
        }

        $this->llave = $llave;
    }

    // ── CIFRAR ────────────────────────────────────────────────────────────────
    /**
     * @param  string $dato Texto plano
     * @return string       Base64 listo para BD
     */
    public function cifrar(string $dato): string{
        $iv  = random_bytes(self::IV_LEN);
        $tag = '';

        $cifrado = openssl_encrypt(
            $dato,
            self::CIPHER,
            $this->llave,
            OPENSSL_RAW_DATA,
            $iv,
            $tag,
            '',
            self::TAG_LEN
        );

        if ($cifrado === FALSE) {
            show_error('Crypto: error al cifrar — ' . openssl_error_string(), 500);
        }

        return base64_encode($iv . $tag . $cifrado);
    }

    // ── DESCIFRAR ─────────────────────────────────────────────────────────────
    /**
     * @param  string $datoBase64 Valor almacenado en BD
     * @return string             Texto plano original
     */
    public function descifrar(?string $datoBase64): string{
        if($datoBase64 == NULL || $datoBase64 == '')
            return '';

        $raw = base64_decode($datoBase64, TRUE);

        if ($raw === FALSE || mb_strlen($raw, '8bit') < self::IV_LEN + self::TAG_LEN) {
            show_error('Crypto: dato cifrado inválido o corrupto.', 500);
        }

        $iv      = mb_substr($raw, 0, self::IV_LEN, '8bit');
        $tag     = mb_substr($raw, self::IV_LEN, self::TAG_LEN, '8bit');
        $cifrado = mb_substr($raw, self::IV_LEN + self::TAG_LEN, NULL, '8bit');

        $plano = openssl_decrypt(
            $cifrado,
            self::CIPHER,
            $this->llave,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        if ($plano === FALSE) {
            show_error('Crypto: descifrado fallido — dato manipulado o llave incorrecta.', 500);
        }

        return $plano;
    }

    // ── HASH CONTRASEÑA (irreversible) ────────────────────────────────────────
    /**
     * Solo para contraseñas — no se puede descifrar, solo verificar
     */
    public function hashPassword(string $password): string{
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    // ── VERIFICAR CONTRASEÑA ──────────────────────────────────────────────────
    /**
     * Tiempo constante — previene ataques de temporización
     */
    public function verificarPassword(string $password, string $hash): bool{
        return password_verify($password, $hash);
    }
}

?>