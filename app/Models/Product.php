<?php

namespace App\Models;

use Dom\Text;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Firefly\FilamentBlog\Enums\ProductStatus;
use Firefly\FilamentBlog\Models\SeoDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class Product extends Model
{
    
use HasFactory;

    public function sorted_images()
{
    return $this->images()->orderByDesc('is_featured')->orderBy('order', 'desc');
}

    protected $casts = [
        'status' => ProductStatus::class,
    ];

    protected $fillable = [
    'title', 
    'code',
    'slug', 
    'body', 
    'status',
    'published_at', 
    'scheduled_for', 
    'price', 
    'user_id',
    'name',
    'mohinhnuoi',
    'thucan',
    'dokhonuoi',
    'giatrikinhte',
    'thoigiannuoi',
    'phuhop',
    'price_min',
    'price_max'];
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id')->orderBy('order','asc');
    }
    public function scopePublished(Builder $query)
    {
        return $query->where('status', ProductStatus::PUBLISHED)->latest('published_at');
    }

       public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
    public function featuredProducts(): BelongsToMany
    {
        return $this->belongsToMany(FeaturedProduct::class, 'featured_product_sanphamphu', 'sanphamphu_id', 'featured_product_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class);
    }

    public function isNotPublished()
    {
        return ! $this->isStatusPublished();
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', ProductStatus::SCHEDULED)->latest('scheduled_for');
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', ProductStatus::PENDING)->latest('created_at');
    }

    public function formattedPublishedDate()
    {
        return $this->published_at?->format('d M Y');
    }

    public function isScheduled()
    {
        return $this->status === ProductStatus::SCHEDULED;
    }

    public function isStatusPublished()
    {
        return $this->status === ProductStatus::PUBLISHED;
    }

  public function getFeaturePhotoAttribute()
{
    $featured = $this->images()->where('is_featured', true)->first();

    return $featured
        ? asset('storage/' . $featured->image_path)
        : ($this->images->first() ? asset('storage/' . $this->images->first()->image_path) : null);
}

    public static function getForm()
    {
        return [
            Section::make('Thông tin sản phẩm')
                ->schema([
                    Fieldset::make('Titles')->label('Tổng quan sản phẩm')
                        ->schema([
                            Select::make('category_id')->label('Danh mục')
                                ->multiple()
                                ->preload()
                                ->createOptionForm(Category::getForm())
                                ->searchable()
                                ->relationship('categories', 'name')
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->label('Tiêu đề hiển thị sản phẩm')
                                ->live(true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state)
                                ))
                                ->required()
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->label('Đường dẫn tĩnh')
                                ->maxLength(255),
                            TextInput::make('code')
                                ->label('Mã sản phẩm')
                                ->default(fn() => 'SP-' . strtoupper(Str::random(6)))
                                ->disabled()
                                ->dehydrated() // vẫn lưu vào database
                                ->maxLength(20),

                            TextInput::make('name')
                                ->label('Tên sản phẩm- Cách gọi')
                                ->maxLength(255),
                            TextInput::make('mohinhnuoi')
                                ->label('Mô hình nuôi')
                                ->maxLength(255),
                            TextInput::make('thucan')
                                ->label('Thức ăn')
                                ->maxLength(255),
                            TextInput::make('dokhonuoi')
                                ->label('Độ khó nuôi')
                                ->maxLength(255),
                            TextInput::make('giatrikinhte')
                                ->label('Giá trị kinh tế')
                                ->maxLength(255),
                            TextInput::make('thoigiannuoi')
                                ->label('Thời gian nuôi')
                                ->maxLength(255),
                            TextInput::make('phuhop')
                                ->label('Đối tượng nuôi phù hợp')
                                ->maxLength(255), 
                            TextInput::make('price')
                                ->label('Giá sản phẩm (VND)')
                                ->numeric(),
                            TextInput::make('price_min')
                                ->label('Giá tối thiểu (VND)')
                                ->numeric(),
                            TextInput::make('price_max')
                                ->label('Giá tối đa (VND)')
                                ->numeric(),


                        ]),
                    TiptapEditor::make('body')
                        ->label('Mô tả chi tiết sản phẩm')
                        ->profile('default')
                        ->disableFloatingMenus()
                        ->extraInputAttributes(['style' => 'max-height: 30rem; min-height: 24rem'])
                        ->required()
                        ->columnSpanFull(),
     Fieldset::make('Hình ảnh sản phẩm')
        ->schema([

        Repeater::make('images')
            ->label('')
            ->relationship('images')
            ->schema([

                FileUpload::make('image_path')
                    ->label('Ảnh')
                    ->directory('product-images')
                    ->image()
                    ->preserveFilenames()
                    ->imageEditor()
                    ->required(),

                TextInput::make('photo_alt_text')
                    ->label('Mô tả ảnh (Alt text)')
                    ->placeholder('Ví dụ: Cá giống khỏe mạnh trong bể nuôi')
                    ->maxLength(255),

                Toggle::make('is_featured')
                    ->label('Đặt làm ảnh đại diện ')
                    ->helperText('Tick để chọn ảnh này làm ảnh đại diện chính.')
                    ->inline(false),
            ])
            ->minItems(1)
            ->columns(3)
            ->collapsible()
            ->reorderableWithDragAndDrop()
            ->addActionLabel('Thêm ảnh mới'),

     ])
        ->columns(1),



                    Fieldset::make('Status')
                        ->label('Trạng thái sản phẩm')
                        ->schema([

                            ToggleButtons::make('status')
                                ->label('')
                                ->live()
                                ->inline()
                                ->options(ProductStatus::class)
                                ->default(ProductStatus::PENDING->value),

                            DateTimePicker::make('scheduled_for')
                                ->label('Chọn ngày lên lịch')
                                ->visible(function ($get) {
                                    return $get('status') === ProductStatus::SCHEDULED->value;
                                })
                                ->required(function ($get) {
                                    return $get('status') === ProductStatus::SCHEDULED->value;
                                })
                                ->minDate(now()->addMinutes(5))
                                ->native(false),
                        ]),
                        Select::make(config('filamentblog.user.foreign_key'))
                        ->label('Người đăng sản phẩm')
                        ->relationship('user', config('filamentblog.user.columns.name'))
                        ->nullable(false)
                        ->default(auth()->id()),
                ]),
        ];
    }


}

