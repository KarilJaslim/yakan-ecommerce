# 🗺️ Google Maps Integration Guide

## ✅ What's Implemented

Your order tracking page now has **embedded Google Maps** showing the delivery location!

### Features:
- ✅ **No API Key Required** - Uses free Google Maps iframe embed
- ✅ **Dynamic Coordinates** - Admin can set custom delivery locations
- ✅ **Automatic Fallback** - Defaults to Manila if no coordinates set
- ✅ **Beautiful UI** - Integrated with maroon theme
- ✅ **Responsive** - Works on mobile and desktop

---

## 📍 How to Get Coordinates from Google Maps

### Method 1: Right-Click (Easiest)
1. Go to [Google Maps](https://www.google.com/maps)
2. Find the delivery location
3. **Right-click** on the exact spot
4. Click the **coordinates** at the top (e.g., `14.5995, 121.0194`)
5. Coordinates are copied to clipboard!
6. Paste into admin form

### Method 2: Search Address
1. Search for an address on Google Maps
2. Look at the URL: `https://www.google.com/maps/@14.5995,121.0194,15z`
3. The numbers after `@` are: `latitude,longitude`

### Method 3: Share Location
1. Find location on Google Maps
2. Click **Share**
3. Copy the link
4. Extract coordinates from URL

---

## 🎯 How to Use (Admin)

### Setting Delivery Location:

1. **Go to Admin** → Orders → View Order
2. **Scroll to** "Tracking Management" section
3. **Fill in** "Delivery Location" fields:
   - **Delivery Address**: `123 Main St, Manila, Philippines`
   - **Latitude**: `14.5995`
   - **Longitude**: `121.0194`
4. **Click** "Update Tracking Information"
5. **Done!** Map will show on customer tracking page

### Example Coordinates:

| Location | Latitude | Longitude |
|----------|----------|-----------|
| Manila | 14.5995 | 121.0194 |
| Quezon City | 14.6760 | 121.0437 |
| Makati | 14.5547 | 121.0244 |
| Cebu City | 10.3157 | 123.8854 |
| Davao City | 7.1907 | 125.4553 |

---

## 🎨 Customization Options

### Change Map Size:
Edit `resources/views/track-order/show.blade.php`:
```php
height="250"  // Change to 300, 400, etc.
```

### Change Zoom Level:
```php
$mapUrl = "https://maps.google.com/maps?q={$latitude},{$longitude}&t=&z=15&ie=UTF8&iwloc=&output=embed";
//                                                                           ^^ Change 15 to 10-20
```

### Change Map Type:
- `&t=` - Roadmap (default)
- `&t=k` - Satellite
- `&t=h` - Hybrid
- `&t=p` - Terrain

---

## 🚀 Advanced: Add Multiple Markers (Route)

If you want to show the delivery route:

```html
<iframe 
    src="https://www.google.com/maps/embed/v1/directions?key=YOUR_API_KEY&origin=14.5995,121.0194&destination=14.6760,121.0437&mode=driving"
    width="100%" 
    height="300">
</iframe>
```

**Note:** This requires a Google Maps API key (free tier available)

---

## 📱 Mobile Compatibility

The embedded map works perfectly on:
- ✅ iOS Safari
- ✅ Android Chrome
- ✅ All modern browsers
- ✅ WebView (for React Native apps)

---

## 🔒 Privacy & Security

- ✅ No tracking cookies
- ✅ No personal data sent to Google
- ✅ Read-only map (users can't edit)
- ✅ HTTPS secure

---

## 💡 Tips

1. **Test First**: Use Manila coordinates (14.5995, 121.0194) to test
2. **Be Precise**: More decimal places = more accurate location
3. **Verify**: Click "Preview Customer Tracking Page" to see the map
4. **Update Often**: Change coordinates as delivery progresses

---

## 🐛 Troubleshooting

### Map Not Showing?
- Check if coordinates are valid numbers
- Ensure latitude is between -90 and 90
- Ensure longitude is between -180 and 180
- Clear browser cache

### Wrong Location?
- Verify coordinates are correct (latitude, longitude order matters!)
- Check if you swapped lat/long (common mistake)

### Map Too Small?
- Increase `height="250"` in the view file
- Adjust zoom level in URL (`&z=15`)

---

## 📚 Resources

- [Google Maps Embed Documentation](https://developers.google.com/maps/documentation/embed)
- [Find Coordinates](https://www.google.com/maps)
- [Coordinate Converter](https://www.latlong.net/)

---

## ✨ Future Enhancements

Want more features? Consider:
- 🚚 Real-time GPS tracking
- 📍 Multiple delivery stops
- 🛣️ Route visualization
- 📊 Distance calculation
- ⏱️ ETA estimation

---

**Enjoy your new map feature!** 🗺️✨
