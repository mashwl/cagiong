<?php

namespace App\Models;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Firefly\FilamentBlog\Models\SeoDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Sanphamphu extends Model
{

    protected $fillable = [
        'code',
        'title',
        'name',
        'slug',
        'body',
        'price',
        'user_id',
    ];
        public function hinhanhs()
    {
        return $this->hasMany(SppImage::class,'sanphamphu_id')->orderBy('order','asc');
    }
    public function getSortedImagesAttribute() {
        return $this->hinhanhs()->orderBy('is_featured', 'desc')->orderBy('order')->get();
    }
    

       public function danhmuc()
    {
        return $this->belongsToMany(SppCategory::class, 'spp_sppcategory');
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


  public function getFeaturePhotoAttribute()
{
    $featured = $this->hinhanhs()->where('is_featured', true)->first();

    return $featured
        ? asset('storage/' . $featured->image_path)
        : ($this->hinhanhs->first() ? asset('storage/' . $this->hinhanhs->first()->image_path) : null);
}

       public static function getForm()
    {
        return [
            Section::make('Thông tin sản phẩm')
                ->schema([
                    Fieldset::make('Titles')->label('Tổng quan sản phẩm')
                        ->schema([
                            Select::make('spp_category_id')->label('Danh mục')
                                ->multiple()
                                ->preload()
                                ->createOptionForm(SppCategory::getForm())
                                ->searchable()
                                ->relationship('danhmuc', 'name')
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
                                ->maxLength(20),
                            TextInput::make('name')
                                ->label('Tên sản phẩm- Cách gọi')
                                ->maxLength(255),
                            TextInput::make('price')
                                ->label('Giá sản phẩm (VND)')
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

        Repeater::make('hinhanhs')
            ->label('')
            ->relationship('hinhanhs')
            ->schema([

                FileUpload::make('image_path')
                    ->label('Ảnh')
                    ->directory('spp-images')
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
           Select::make(config('filamentblog.user.foreign_key'))
                        ->label('Người đăng sản phẩm')
                        ->relationship('user', config('filamentblog.user.columns.name'))
                        ->nullable(false)
                        ->default(auth()->id()),
                ])
                 
        ];
    }       
}
