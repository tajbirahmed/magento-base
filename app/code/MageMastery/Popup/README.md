
```php
// Get popup by ID
$popupRepository = $objectManager->get(\MageMastery\Popup\Api\PopupRepositoryInterface::class);
$popup = $popupRepository->getById(1);

// Get active popups collection
$collection = $popupRepository->getActivePopups();

// Create new popup
$popup = $objectManager->create(\MageMastery\Popup\Model\Popup::class);
$popup->setTitle('Welcome Popup')
      ->setContent('<h2>Welcome to our store!</h2>')
      ->setIsActive(true)
      ->setPopupType('modal');
$popupRepository->save($popup);
```

### Database Indexes

The following indexes are created for optimal performance:
- `is_active` - For filtering active popups
- `popup_type` - For filtering by popup type
- `trigger_type` - For filtering by trigger type
- `start_date, end_date` - For date range filtering
