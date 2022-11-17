<?php

// créer une lib pour les besoins spécifiques
// validation HTML requise
// exigences clients selon les besoins

class NoSQL {
    const OP_EQ = '=';
    const OP_LR = '<';
    const OP_GR = '>';
    const OP_LE = '<=';
    const OP_GE = '>=';
    const OP_NE = '!=';
    const OP_LK = 'like';
    const OP_IN = 'in';
    
    protected static $storePath = './';
    public static function configure(string $storePath): void {
        static::$storePath = $storePath;
    }
    
    protected static $instances = [];
    public static function getInstance(string $catalog): NoSQL {
        if(!array_key_exists($catalog, static::$instances)) {
            static::$instances[$catalog] = new NoSQL($catalog);
        }
        return static::$instances[$catalog];
    }
    
    protected static function escapePath(string $toEscape): string {
        return preg_replace('`[^a-zA-Z0-9_/-]`', '', str_replace(DIRECTORY_SEPARATOR, '/', $toEscape));
    }
    
    protected $storage = null;
    protected $path = null;
    
    public function __construct(string $catalog) {
        $this->path = __DIR__.'/'.static::escapePath(static::$storePath.'/'.$catalog).'.json';
        $this->warmup();
        $this->load();
    }
    
    public function warmup() {
        if(!file_exists($this->path)) {
            $parentDir = static::escapePath(static::$storePath);
            if(!file_exists($parentDir)) {
                mkdir($parentDir);
            }
            $fh = fopen($this->path, 'w+');
            fwrite($fh, json_encode([
                'ai' => 0,
                'data' => [],
            ]));
            fclose($fh);
        }
    }
    
    protected function load(): void {
        $this->storage = json_decode(trim(file_get_contents($this->path)), true);
    }
    
    protected function flush(): void {
        $fh = fopen($this->path, 'w+');
        flock($fh, LOCK_EX);
        fwrite($fh, json_encode($this->storage));
        fclose($fh); // will also unlock
    }
    
    public function save(array $content) {
        if(!array_key_exists('id', $content)) {
            do {
                $this->storage['ai']++;
                $content['id'] = strval($this->storage['ai']);
            } while(array_key_exists(strval($this->storage['ai']), $this->storage['data']));
        }
        $this->storage['data'][$content['id']] = $content;
        $this->flush();
        return $content;
    }
    
    public function delete(string $id) {
        if($this->exists($id)) {
            $content = $this->find($id);
            unset($this->storage['data'][$content['id']]);
            $this->flush();
        }
    }
    
    public function exists(string $id): bool {
        return array_key_exists($id, $this->storage['data']);
    }
    
    public function find(string $id, $ifNoFound = null) {
        return $this->exists($id)? ($this->storage['data'][$id]):$ifNoFound;
    }
    
    public function all(): array {
        return $this->storage['data'];
    }
    
    public function truncate(): void {
        $this->storage['data'] = [];
        $this->flush();
    }
    
    protected function isSearchedFor($currentValue, string $op, $searchedValue) {
        return 
            ((static::OP_EQ === $op) && ($currentValue === $searchedValue))
            ||
            ((static::OP_GE === $op) && ($currentValue >= $searchedValue))
            ||
            ((static::OP_LE === $op) && ($currentValue <= $searchedValue))
            ||
            ((static::OP_GR === $op) && ($currentValue > $searchedValue))
            ||
            ((static::OP_LR === $op) && ($currentValue > $searchedValue))
            ||
            ((static::OP_NE === $op) && ($currentValue != $searchedValue))
            ||
            ((static::OP_LK === $op) && (false !== stripos($currentValue, $searchedValue)))
            ||
            ((static::OP_IN === $op) && is_array($currentValue) && in_array($searchedValue, $currentValue));
    }
    
    public function search(string $field, $value, string $op): array {
        $returns = [];
        foreach($this->storage['data'] as $k => $v) {
            if(array_key_exists($field, $v)) {
                if($this->isSearchedFor($v[$field], $op, $value)) {
                    $returns[$k] = $v;
                }
            }
        }
        return $returns;
    }
    
    public function searchOne(string $field, $value, string $op, $ifNoFound = null) {
        $returns = $ifNoFound;
        foreach($this->storage['data'] as $k => $v) {
            if(array_key_exists($field, $v)) {
                if($this->isSearchedFor($v[$field], $op, $value)) {
                    $returns = $v;
                    break;
                }
            }
        }
        return $returns;
    }
}

