<?php

namespace MageMastery\Popup\Api\Data;

interface PopupInterface
{
    public function getId(): int;

    public function setId($popupId): void;

    public function getName(): string;

    public function setName(string $title): void;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getIsActive(): bool;

    public function setIsActive(bool $isActive): void;

    public function getCreatedAt(): string;

    public function setCreatedAt(string $createdAt): void;

    public function getUpdatedAt(): string;

    public function setUpdatedAt(string $updatedAt): void;
    public function getTimeout(): int;
    public function setTimeout(int $timeout): void;
}
