<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Book;
use Filament\Tables;
use App\Models\Status;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\BookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookResource\RelationManagers;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Manajemen Perpustakaan';

    protected static ?string $navigationLabel = 'Buku';

    protected static ?string $label = 'Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->label('Foto Buku')
                    ->columnSpanFull()
                    ->directory('Book Image')
                    ->required(),
                Select::make('category_id')
                    ->required()
                    ->label('Kategori')
                    ->searchable()
                    ->columnSpanFull()
                    ->options(Category::pluck('name', 'id')),
                TextInput::make('book_code')
                    ->required()
                    ->label('Kode Buku')
                    ->default('BOOK-' . mt_rand(1000000000, 9999999999))
                    ->maxLength(16),
                TextInput::make('author')
                    ->label('Penulis')
                    ->required()
                    ->maxLength(128),
                TextInput::make('title')
                    ->required()
                    ->label('Judul Buku')
                    ->columnSpanFull()
                    ->label('Judul')
                    ->maxLength(255),
                DatePicker::make('year_publish')
                    ->label('Tahun Terbit')
                    ->native(false)
                    ->required(),
                TextInput::make('quantity')
                    ->label('Jumlah Buku')
                    ->required()
                    ->numeric(),
                Textarea::make('desc')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->searchable()
                    ->columnSpanFull()
                    ->options(Status::where('status_type_id', 2)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->size(70)
                    ->height(100)
                    ->label('Foto Buku'),
                TextColumn::make('title')
                    ->label('Judul Buku')
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('book_code')
                    ->label('Kode Buku')
                    ->searchable(),
                TextColumn::make('year_publish')
                    ->label('Tahun Terbit')
                    ->date()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Jumlah Buku')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('desc')
                    ->label('Deskripsi')
                    ->limit(50),
                TextColumn::make('status.name')
                    ->label('Status'),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
                TextColumn::make('updatedBy.name')
                    ->label("Updated by"),
                TextColumn::make('deletedBy.name')
                    ->label("Deleted by"),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Buku')
                    ->icon('heroicon-m-book-open')
                    ->description('Informasi detail mengenai buku yang tersedia di perpustakaan, termasuk kategori, penulis, tahun terbit, dan status ketersediaan.')
                    ->aside()
                    ->schema([
                        ImageEntry::make('image')
                            ->size(100)
                            ->height(140)
                            ->label('Foto Buku')
                            ->columnSpanFull()
                            ->alignment('center'),
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextEntry::make('book_code')
                                    ->label('Kode Buku')
                                    ->columnSpan(1),
                                TextEntry::make('title')
                                    ->label('Judul Buku')
                                    ->columnSpan(1),
                                TextEntry::make('author')
                                    ->label('Penulis'),
                                TextEntry::make('category.name')
                                    ->label('Kategori'),
                                TextEntry::make('year_publish')
                                    ->label('Tahun Terbit'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah Buku'),
                                ]),
                        TextEntry::make('desc')
                            ->label('Deskripsi'),
                        TextEntry::make('status.name')
                            ->label('Status'),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
