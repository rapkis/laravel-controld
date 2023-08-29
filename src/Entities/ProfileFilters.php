<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

/** TODO
 * these filters are poorly documented and it is not
 * always clear what they stand for or what data
 * they carry within
 */
class ProfileFilters
{
    public function __construct(
        public readonly array $flt,
        public readonly array $cflt,
        public readonly array $ipflt,
        public readonly array $rule,
        public readonly array $svc,
        public readonly array $grp,
        public readonly array $opt,
        public readonly array $da,
    ) {
    }
}
