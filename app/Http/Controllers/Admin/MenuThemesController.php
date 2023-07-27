<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuTheme;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuThemesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_theme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuThemes = MenuTheme::all();

        return view('admin.menuThemes.index', compact('menuThemes'));
    }
}
