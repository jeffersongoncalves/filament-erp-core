<?php

namespace JeffersonGoncalves\FilamentErp\Core\Concerns;

/**
 * Generic plugin-config base for the ERP Filament plugins. Provides the shared
 * make()/get() factory helpers, the navigation-group override and the swappable
 * resource/widget override-map plumbing. A consuming plugin supplies its config
 * key and default navigation group via the two abstract methods.
 */
trait HasErpPluginConfig
{
    protected ?string $navigationGroup = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function navigationGroup(?string $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup
            ?? config($this->getConfigKey().'.navigation_group', $this->getDefaultNavigationGroup());
    }

    /**
     * Merge the per-resource config overrides over the plugin defaults,
     * preserving the supplied order.
     *
     * @param  array<string, class-string>  $defaults  override-key => default resource class
     * @return array<int, class-string>
     */
    protected function resolveResources(array $defaults): array
    {
        /** @var array<string, class-string> $overrides */
        $overrides = config($this->getConfigKey().'.resources', []);

        return array_map(
            fn (string $key, string $default): string => $overrides[$key] ?? $default,
            array_keys($defaults),
            array_values($defaults),
        );
    }

    /**
     * @return array<int, class-string>
     */
    protected function resolveWidgets(): array
    {
        /** @var array<string, class-string> $widgets */
        $widgets = config($this->getConfigKey().'.widgets', []);

        return array_values($widgets);
    }

    abstract protected function getConfigKey(): string;

    abstract protected function getDefaultNavigationGroup(): string;
}
