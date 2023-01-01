<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Fundraiser;
use App\Models\Project;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FundraiserController extends Controller
{
    protected $province = "'W3sicHJvdmluc2kiOiJBY2VoIiwia290YSI6WyJLb3RhIEJhbmRhIEFjZWgiLCJLb3RhIFNhYmFuZyIsIktvdGEgTGhva3NldW1hd2UiLCJLb3RhIExhbmdzYSIsIktvdGEgU3VidWx1c3NhbGFtIiwiS2FiLiBBY2VoIFNlbGF0YW4iLCJLYWIuIEFjZWggVGVuZ2dhcmEiLCJLYWIuIEFjZWggVGltdXIiLCJLYWIuIEFjZWggVGVuZ2FoIiwiS2FiLiBBY2VoIEJhcmF0IiwiS2FiLiBBY2VoIEJlc2FyIiwiS2FiLiBQaWRpZSIsIkthYi4gQWNlaCBVdGFyYSIsIkthYi4gU2ltZXVsdWUiLCJLYWIuIEFjZWggU2luZ2tpbCIsIkthYi4gQmlyZXVuIiwiS2FiLiBBY2VoIEJhcmF0IERheWEiLCJLYWIuIEdheW8gTHVlcyIsIkthYi4gQWNlaCBKYXlhIiwiS2FiLiBOYWdhbiBSYXlhIiwiS2FiLiBBY2VoIFRhbWlhbmciLCJLYWIuIEJlbmVyIE1lcmlhaCIsIkthYi4gUGlkaWUgSmF5YSJdfSx7InByb3ZpbnNpIjoiU3VtYXRlcmEgVXRhcmEiLCJrb3RhIjpbIktvdGEgTWVkYW4iLCJLb3RhIFBlbWF0YW5nIFNpYW50YXIiLCJLb3RhIFNpYm9sZ2EiLCJLb3RhIFRhbmp1bmcgQmFsYWkiLCJLb3RhIEJpbmphaSIsIktvdGEgVGViaW5nIFRpbmdnaSIsIktvdGEgUGFkYW5nIFNpZGVtcHVhbiIsIktvdGEgR3VudW5nIFNpdG9saSIsIkthYi4gU2VyZGFuZyBCZWRhZ2FpIiwiS2FiLiBTYW1vc2lyICIsIkthYi4gSHVtYmFuZyBIYXN1bmR1dGFuIiwiS2FiLiBQYWtwYWsgQmhhcmF0IiwiS2FiLiBOaWFzIFNlbGF0YW4iLCJLYWIuIE1hbmRhaWxpbmcgTmF0YWwiLCJLYWIuIFRvYmEgU2Ftb3NpciIsIkthYi4gRGFpcmkiLCJLYWIuIExhYnVoYW4gQmF0dSIsIkthYi4gQXNhaGFuIiwiS2FiLiBTaW1hbHVuZ3VuIiwiS2FiLiBEZWxpIFNlcmRhbmciLCJLYWIuIEthcm8iLCJLYWIuIExhbmdrYXQiLCJLYWIuIE5pYXMiLCJLYWIuIFRhcGFudWxpIFNlbGF0YW4iLCJLYWIuIFRhcGFudWxpIFV0YXJhIiwiS2FiLiBUYXBhbnVsaSBUZW5nYWgiLCJLYWIuIEJhdHUgQmFyYSIsIkthYi4gUGFkYW5nIExhd2FzIFV0YXJhIiwiS2FiLiBQYWRhbmcgTGF3YXMiLCJLYWIuIExhYnVoYW5iYXR1IFNlbGF0YW4iLCJLYWIuIExhYnVoYW5iYXR1IFV0YXJhIiwiS2FiLiBOaWFzIFV0YXJhIiwiS2FiLiBOaWFzIEJhcmF0Il19LHsicHJvdmluc2kiOiJTdW1hdGVyYSBCYXJhdCIsImtvdGEiOlsiS290YSBQYWRhbmciLCJLb3RhIFNvbG9rIiwiS290YSBTYXdobHVudG8iLCJLb3RhIFBhZGFuZyBQYW5qYW5nIiwiS290YSBCdWtpdHRpbmdnaSIsIktvdGEgUGF5YWt1bWJ1aCIsIktvdGEgUGFyaWFtYW4iLCJLYWIuIFBhc2FtYW4gQmFyYXQiLCJLYWIuIFNvbG9rIFNlbGF0YW4iLCJLYWIuIERoYXJtYXNyYXlhIiwiS2FiLiBLZXB1bGF1YW4gTWVudGF3YWkiLCJLYWIuIFBhc2FtYW4iLCJLYWIuIExpbWEgUHVsdWggS290YSIsIkthYi4gQWdhbSIsIkthYi4gUGFkYW5nIFBhcmlhbWFuIiwiS2FiLiBUYW5haCBEYXRhciIsIkthYi4gU2lqdW5qdW5nIiwiS2FiLiBTb2xvayIsIkthYi4gUGVzaXNpciBTZWxhdGFuIl19LHsicHJvdmluc2kiOiJSaWF1Iiwia290YSI6WyJLb3RhIFBla2FuIEJhcnUiLCJLb3RhIER1bWFpIiwiS2FiLiBLZXB1bGF1YW4gTWVyYW50aSIsIkthYi4gS3VhbnRhbiBTaW5naW5naSIsIkthYi4gU2lhayIsIkthYi4gUm9rYW4gSGlsaXIiLCJLYWIuIFJva2FuIEh1bHUiLCJLYWIuIFBlbGFsYXdhbiIsIkthYi4gSW5kcmFnaXJpIEhpbGlyIiwiS2FiLiBCZW5na2FsaXMiLCJLYWIuIEluZHJhZ2lyaSBIdWx1IiwiS2FiLiBLYW1wYXIiXX0seyJwcm92aW5zaSI6IkphbWJpIiwia290YSI6WyJLb3RhIEphbWJpIiwiS290YSBTdW5nYWkgUGVudWgiLCJLYWIuIFRlYm8iLCJLYWIuIEJ1bmdvIiwiS2FiLiBUYW5qdW5nIEphYnVuZyBUaW11ciIsIkthYi4gVGFuanVuZyBKYWJ1bmcgQmFyYXQiLCJLYWIuIE11YXJvIEphbWJpIiwiS2FiLiBCYXRhbmdoYXJpIiwiS2FiLiBTYXJvbGFuZ3VuIiwiS2FiLiBNZXJhbmdpbiIsIkthYi4gS2VyaW5jaSJdfSx7InByb3ZpbnNpIjoiU3VtYXRlcmEgU2VsYXRhbiIsImtvdGEiOlsiS290YSBQYWxlbWJhbmciLCJLb3RhIFBhZ2FyIEFsYW0iLCJLb3RhIEx1YnVrIExpbmdnYXUiLCJLb3RhIFByYWJ1bXVsaWgiLCJLYWIuIE11c2kgUmF3YXMgVXRhcmEiLCJLYWIuIFBlbnVrYWwgQWJhYiBMZW1hdGFuZyBJbGlyIiwiS2FiLiBFbXBhdCBMYXdhbmciLCJLYWIuIE9nYW4gSWxpciAiLCJLYWIuIE9nYW4gS29tZXJpbmcgVWx1IFNlbGF0YW4gIiwiS2FiLiBPZ2FuIEtvbWVyaW5nIFVsdSBUaW11ciAiLCJLYWIuIEJhbnl1YXNpbiIsIkthYi4gTXVzaSBCYW55dWFzaW4iLCJLYWIuIE11c2kgUmF3YXMiLCJLYWIuIExhaGF0IiwiS2FiLiBNdWFyYSBFbmltIiwiS2FiLiBPZ2FuIEtvbWVyaW5nIElsaXIiLCJLYWIuIE9nYW4gS29tZXJpbmcgVWx1Il19LHsicHJvdmluc2kiOiJCZW5na3VsdSIsImtvdGEiOlsiS290YSBCZW5na3VsdSIsIkthYi4gQmVuZ2t1bHUgVGVuZ2FoIiwiS2FiLiBLZXBhaGlhbmcgIiwiS2FiLiBMZWJvbmciLCJLYWIuIE11a28gTXVrbyIsIkthYi4gU2VsdW1hIiwiS2FiLiBLYXVyIiwiS2FiLiBCZW5na3VsdSBVdGFyYSIsIkthYi4gUmVqYW5nIExlYm9uZyIsIkthYi4gQmVuZ2t1bHUgU2VsYXRhbiJdfSx7InByb3ZpbnNpIjoiTGFtcHVuZyIsImtvdGEiOlsiS290YSBCYW5kYXIgTGFtcHVuZyIsIktvdGEgTWV0cm8iLCJLYWIuIFBlc2lzaXIgQmFyYXQiLCJLYWIuIFR1bGFuZ2Jhd2FuZyBCYXJhdCIsIkthYi4gTWVzdWppIiwiS2FiLiBQcmluZ3Nld3UiLCJLYWIuIFBlc2F3YXJhbiIsIkthYi4gV2F5IEthbmFuIiwiS2FiLiBMYW1wdW5nIFRpbXVyIiwiS2FiLiBUYW5nZ2FtdXMiLCJLYWIuIFR1bGFuZyBCYXdhbmciLCJLYWIuIExhbXB1bmcgQmFyYXQiLCJLYWIuIExhbXB1bmcgVXRhcmEiLCJLYWIuIExhbXB1bmcgVGVuZ2FoIiwiS2FiLiBMYW1wdW5nIFNlbGF0YW4iXX0seyJwcm92aW5zaSI6IktlcHVsYXVhbiBCYW5na2EgQmVsaXR1bmciLCJrb3RhIjpbIktvdGEgUGFuZ2thbCBQaW5hbmciLCJLYWIuIEJlbGl0dW5nIFRpbXVyIiwiS2FiLiBCYW5na2EgQmFyYXQiLCJLYWIuIEJhbmdrYSBUZW5nYWgiLCJLYWIuIEJhbmdrYSBTZWxhdGFuIiwiS2FiLiBCZWxpdHVuZyIsIkthYi4gQmFuZ2thIl19LHsicHJvdmluc2kiOiJLZXB1bGF1YW4gUmlhdSIsImtvdGEiOlsiS290YSBCYXRhbSIsIktvdGEgVGFuanVuZyBQaW5hbmciLCJLYWIuIEtlcHVsYXVhbiBBbmFtYmFzIiwiS2FiLiBMaW5nZ2EgIiwiS2FiLiBOYXR1bmEiLCJLYWIuIEthcmltdW4iLCJLYWIuIEJpbnRhbiJdfSx7InByb3ZpbnNpIjoiREtJIEpha2FydGEiLCJrb3RhIjpbIktvdGEgSmFrYXJ0YSBUaW11ciIsIktvdGEgSmFrYXJ0YSBTZWxhdGFuIiwiS290YSBKYWthcnRhIEJhcmF0IiwiS290YSBKYWthcnRhIFV0YXJhIiwiS290YSBKYWthcnRhIFB1c2F0IiwiS2FiLiBLZXB1bGF1YW4gU2VyaWJ1Il19LHsicHJvdmluc2kiOiJKYXdhIEJhcmF0Iiwia290YSI6WyJLb3RhIEJhbmR1bmciLCJLb3RhIEJhbmphciIsIktvdGEgVGFzaWttYWxheWEiLCJLb3RhIENpbWFoaSIsIktvdGEgRGVwb2siLCJLb3RhIEJla2FzaSIsIktvdGEgQ2lyZWJvbiIsIktvdGEgU3VrYWJ1bWkiLCJLb3RhIEJvZ29yIiwiS2FiLiBQYW5nYW5kYXJhbiIsIkthYi4gQmFuZHVuZyBCYXJhdCIsIkthYi4gQmVrYXNpIiwiS2FiLiBLYXJhd2FuZyIsIkthYi4gUHVyd2FrYXJ0YSIsIkthYi4gU3ViYW5nIiwiS2FiLiBJbmRyYW1heXUiLCJLYWIuIFN1bWVkYW5nIiwiS2FiLiBNYWphbGVuZ2thIiwiS2FiLiBDaXJlYm9uIiwiS2FiLiBLdW5pbmdhbiIsIkthYi4gQ2lhbWlzIiwiS2FiLiBUYXNpa21hbGF5YSIsIkthYi4gR2FydXQiLCJLYWIuIEJhbmR1bmciLCJLYWIuIENpYW5qdXIiLCJLYWIuIFN1a2FidW1pIiwiS2FiLiBCb2dvciJdfSx7InByb3ZpbnNpIjoiSmF3YSBUZW5nYWgiLCJrb3RhIjpbIktvdGEgU2VtYXJhbmciLCJLb3RhIFRlZ2FsIiwiS290YSBQZWthbG9uZ2FuIiwiS290YSBTYWxhdGlnYSIsIktvdGEgU3VyYWthcnRhIiwiS290YSBNYWdlbGFuZyIsIkthYi4gQnJlYmVzIiwiS2FiLiBUZWdhbCIsIkthYi4gUGVtYWxhbmciLCJLYWIuIFBla2Fsb25nYW4iLCJLYWIuIEJhdGFuZyIsIkthYi4gS2VuZGFsIiwiS2FiLiBUZW1hbmdndW5nIiwiS2FiLiBTZW1hcmFuZyIsIkthYi4gRGVtYWsiLCJLYWIuIEplcGFyYSIsIkthYi4gS3VkdXMiLCJLYWIuIFBhdGkiLCJLYWIuIFJlbWJhbmciLCJLYWIuIEJsb3JhIiwiS2FiLiBHcm9ib2dhbiIsIkthYi4gU3JhZ2VuIiwiS2FiLiBLYXJhbmdhbnlhciIsIkthYi4gV29ub2dpcmkiLCJLYWIuIFN1a29oYXJqbyIsIkthYi4gS2xhdGVuIiwiS2FiLiBCb3lvbGFsaSIsIkthYi4gTWFnZWxhbmciLCJLYWIuIFdvbm9zb2JvIiwiS2FiLiBQdXJ3b3Jlam8iLCJLYWIuIEtlYnVtZW4iLCJLYWIuIEJhbmphcm5lZ2FyYSIsIkthYi4gUHVyYmFsaW5nZ2EiLCJLYWIuIEJhbnl1bWFzIiwiS2FiLiBDaWxhY2FwIl19LHsicHJvdmluc2kiOiJESSBZb2d5YWthcnRhIiwia290YSI6WyJLb3RhIFlvZ3lha2FydGEiLCJLYWIuIFNsZW1hbiIsIkthYi4gR3VudW5nIEtpZHVsIiwiS2FiLiBCYW50dWwiLCJLYWIuIEt1bG9uIFByb2dvIl19LHsicHJvdmluc2kiOiJKYXdhIFRpbXVyIiwia290YSI6WyJLb3RhIFN1cmFiYXlhIiwiS290YSBCYXR1IiwiS290YSBNYWRpdW4iLCJLb3RhIE1vam9rZXJ0byIsIktvdGEgUGFzdXJ1YW4iLCJLb3RhIFByb2JvbGluZ2dvIiwiS290YSBNYWxhbmciLCJLb3RhIEJsaXRhciIsIktvdGEgS2VkaXJpIiwiS2FiLiBTdW1lbmVwIiwiS2FiLiBQYW1la2FzYW4iLCJLYWIuIFNhbXBhbmciLCJLYWIuIEJhbmdrYWxhbiIsIkthYi4gR3Jlc2lrIiwiS2FiLiBMYW1vbmdhbiIsIkthYi4gVHViYW4iLCJLYWIuIEJvam9uZWdvcm8iLCJLYWIuIE5nYXdpIiwiS2FiLiBNYWdldGFuIiwiS2FiLiBNYWRpdW4iLCJLYWIuIE5nYW5qdWsiLCJLYWIuIEpvbWJhbmciLCJLYWIuIE1vam9rZXJ0byIsIkthYi4gU2lkb2Fyam8iLCJLYWIuIFBhc3VydWFuIiwiS2FiLiBQcm9ib2xpbmdnbyIsIkthYi4gU2l0dWJvbmRvIiwiS2FiLiBCb25kb3dvc28iLCJLYWIuIEJhbnl1d2FuZ2kiLCJLYWIuIEplbWJlciIsIkthYi4gTHVtYWphbmciLCJLYWIuIE1hbGFuZyIsIkthYi4gS2VkaXJpIiwiS2FiLiBCbGl0YXIiLCJLYWIuIFR1bHVuZ2FndW5nIiwiS2FiLiBUcmVuZ2dhbGVrIiwiS2FiLiBQb25vcm9nbyIsIkthYi4gUGFjaXRhbiJdfSx7InByb3ZpbnNpIjoiQmFudGVuIiwia290YSI6WyJLb3RhIFNlcmFuZyIsIktvdGEgQ2lsZWdvbiIsIktvdGEgVGFuZ2VyYW5nIiwiS290YSBUYW5nZXJhbmcgU2VsYXRhbiIsIkthYi4gU2VyYW5nIiwiS2FiLiBUYW5nZXJhbmciLCJLYWIuIExlYmFrIiwiS2FiLiBQYW5kZWdsYW5nIl19LHsicHJvdmluc2kiOiJCYWxpIiwia290YSI6WyJLb3RhIERlbnBhc2FyIiwiS2FiLiBCdWxlbGVuZyIsIkthYi4gS2FyYW5nYXNlbSIsIkthYi4gQmFuZ2xpIiwiS2FiLiBLbHVuZ2t1bmciLCJLYWIuIEdpYW55YXIiLCJLYWIuIEJhZHVuZyIsIkthYi4gVGFiYW5hbiIsIkthYi4gSmVtYnJhbmEiXX0seyJwcm92aW5zaSI6Ik51c2EgVGVuZ2dhcmEgQmFyYXQiLCJrb3RhIjpbIktvdGEgTWF0YXJhbSIsIktvdGEgQmltYSIsIkthYi4gTG9tYm9rIFV0YXJhIiwiS2FiLiBTdW1iYXdhIEJhcmF0IiwiS2FiLiBCaW1hIiwiS2FiLiBEb21wdSIsIkthYi4gU3VtYmF3YSAiLCJLYWIuIExvbWJvayBUaW11ciIsIkthYi4gTG9tYm9rIFRlbmdhaCIsIkthYi4gTG9tYm9rIEJhcmF0Il19LHsicHJvdmluc2kiOiJOdXNhIFRlbmdnYXJhIFRpbXVyIiwia290YSI6WyJLb3RhIEt1cGFuZyIsIkthYi4gTWFsYWthIiwiS2FiLiBTYWJ1IFJhaWp1YSIsIkthYi4gTWFuZ2dhcmFpIFRpbXVyIiwiS2FiLiBTdW1iYSBCYXJhdCBEYXlhIiwiS2FiLiBTdW1iYSBUZW5nYWgiLCJLYWIuIE5hZ2VrZW8iLCJLYWIuIE1hbmdnYXJhaSBCYXJhdCIsIkthYi4gUm90ZSBOZGFvIiwiS2FiLiBMZW1iYXRhIiwiS2FiLiBTdW1iYSBCYXJhdCIsIkthYi4gU3VtYmEgVGltdXIiLCJLYWIuIE1hbmdnYXJhaSIsIkthYi4gTmdhZGEiLCJLYWIuIEVuZGUiLCJLYWIuIFNpa2thIiwiS2FiLiBGbG9yZXMgVGltdXIiLCJLYWIuIEFsb3IiLCJLYWIuIEJlbHUiLCJLYWIuIFRpbW9yIFRlbmdhaCBVdGFyYSIsIkthYi4gVGltb3IgVGVuZ2FoIFNlbGF0YW4iLCJLYWIuIEt1cGFuZyJdfSx7InByb3ZpbnNpIjoiS2FsaW1hbnRhbiBCYXJhdCIsImtvdGEiOlsiS290YSBQb250aWFuYWsiLCJLb3RhIFNpbmdrYXdhbmciLCJLYWIuIEt1YnUgUmF5YSIsIkthYi4gS2F5b25nIFV0YXJhIiwiS2FiLiBTZWthZGF1IiwiS2FiLiBNZWxhd2kiLCJLYWIuIExhbmRhayIsIkthYi4gQmVuZ2theWFuZyIsIkthYi4gS2FwdWFzIEh1bHUiLCJLYWIuIFNpbnRhbmcgIiwiS2FiLiBLZXRhcGFuZyIsIkthYi4gU2FuZ2dhdSAiLCJLYWIuIE1lbXBhd2FoIiwiS2FiLiBTYW1iYXMiXX0seyJwcm92aW5zaSI6IkthbGltYW50YW4gVGVuZ2FoIiwia290YSI6WyJLb3RhIFBhbGFuZ2thcmF5YSIsIkthYi4gQmFyaXRvIFRpbXVyIiwiS2FiLiBNdXJ1bmcgUmF5YSIsIkthYi4gUHVsYW5nIFBpc2F1IiwiS2FiLiBHdW51bmcgTWFzIiwiS2FiLiBMYW1hbmRhdSIsIkthYi4gU3VrYW1hcmEiLCJLYWIuIFNlcnV5YW4iLCJLYWIuIEthdGluZ2FuIiwiS2FiLiBCYXJpdG8gVXRhcmEiLCJLYWIuIEJhcml0byBTZWxhdGFuIiwiS2FiLiBLYXB1YXMiLCJLYWIuIEtvdGF3YXJpbmdpbiBUaW11ciIsIkthYi4gS290YXdhcmluZ2luIEJhcmF0Il19LHsicHJvdmluc2kiOiJLYWxpbWFudGFuIFNlbGF0YW4iLCJrb3RhIjpbIktvdGEgQmFuamFybWFzaW4iLCJLb3RhIEJhbmphcmJhcnUiLCJLYWIuIEJhbGFuZ2FuIiwiS2FiLiBUYW5haCBCYW1idSIsIkthYi4gVGFiYWxvbmciLCJLYWIuIEh1bHUgU3VuZ2FpIFV0YXJhIiwiS2FiLiBIdWx1IFN1bmdhaSBUZW5nYWgiLCJLYWIuIEh1bHUgU3VuZ2FpIFNlbGF0YW4iLCJLYWIuIFRhcGluIiwiS2FiLiBCYXJpdG8gS3VhbGEiLCJLYWIuIEJhbmphciIsIkthYi4gS290YWJhcnUiLCJLYWIuIFRhbmFoIExhdXQiXX0seyJwcm92aW5zaSI6IkthbGltYW50YW4gVGltdXIiLCJrb3RhIjpbIktvdGEgU2FtYXJpbmRhIiwiS290YSBCb250YW5nIiwiS290YSBCYWxpa3BhcGFuIiwiS2FiLiBNYWhha2FtIFVsdSIsIkthYi4gUGVuYWphbSBQYXNlciBVdGFyYSIsIkthYi4gS3V0YWkgVGltdXIiLCJLYWIuIEt1dGFpIEJhcmF0IiwiS2FiLiBCZXJhdSIsIkthYi4gS3V0YWkgS2VydGFuZWdhcmEiLCJLYWIuIFBhc2VyIl19LHsicHJvdmluc2kiOiJLYWxpbWFudGFuIFV0YXJhIiwia290YSI6WyJLb3RhIFRhcmFrYW4iLCJLYWIuIFRhbmEgVGlkdW5nIiwiS2FiLiBOdW51a2FuIiwiS2FiLiBNYWxpbmF1IiwiS2FiLiBCdWx1bmdhbiJdfSx7InByb3ZpbnNpIjoiU3VsYXdlc2kgVXRhcmEiLCJrb3RhIjpbIktvdGEgTWFuYWRvIiwiS290YSBUb21vaG9uIiwiS290YSBCaXR1bmciLCJLb3RhIEtvdGFtb2JhZ3UiLCJLYWIuIEJvbGFhbmcgTWFuZ29uZG93IFNlbGF0YW4iLCJLYWIuIEJvbGFhbmcgTWFuZ29uZG93IFRpbXVyIiwiS2FiLiBLZXB1bGF1YW4gU2lhdSBUYWd1bGFuZGFuZyBCaWFybyIsIkthYi4gQm9sYWFuZyBNYW5nb25kb3cgVXRhcmEiLCJLYWIuIE1pbmFoYXNhIFRlbmdnYXJhIiwiS2FiLiBNaW5haGFzYSBVdGFyYSIsIkthYi4gTWluYWhhc2EgU2VsYXRhbiIsIkthYi4gS2VwdWxhdWFuIFRhbGF1ZCIsIkthYi4gS2VwdWxhdWFuIFNhbmdpaGUiLCJLYWIuIE1pbmFoYXNhIiwiS2FiLiBCb2xhYW5nIE1hbmdvbmRvdyJdfSx7InByb3ZpbnNpIjoiU3VsYXdlc2kgVGVuZ2FoIiwia290YSI6WyJLb3RhIFBhbHUiLCJLYWIuIE1vcm93YWxpIFV0YXJhIiwiS2FiLiBCYW5nZ2FpIExhdXQiLCJLYWIuIFNpZ2kiLCJLYWIuIFRvam8gVW5hLVVuYSIsIkthYi4gUGFyaWdpIE1vdXRvbmciLCJLYWIuIEJhbmdnYWkgS2VwdWxhdWFuIiwiS2FiLiBNb3Jvd2FsaSIsIkthYi4gQnVvbCIsIkthYi4gVG9saS1Ub2xpIiwiS2FiLiBEb25nZ2FsYSIsIkthYi4gUG9zbyIsIkthYi4gQmFuZ2dhaSJdfSx7InByb3ZpbnNpIjoiU3VsYXdlc2kgU2VsYXRhbiIsImtvdGEiOlsiS290YSBNYWthc2FyIiwiS290YSBQYWxvcG8iLCJLb3RhIFBhcmUgUGFyZSIsIkthYi4gVG9yYWphIFV0YXJhIiwiS2FiLiBMdXd1IFRpbXVyIiwiS2FiLiBMdXd1IFV0YXJhIiwiS2FiLiBUYW5hIFRvcmFqYSIsIkthYi4gTHV3dSIsIkthYi4gRW5yZWthbmciLCJLYWIuIFBpbnJhbmciLCJLYWIuIFNpZGVucmVuZyBSYXBwYW5nIiwiS2FiLiBXYWpvIiwiS2FiLiBTb3BwZW5nIiwiS2FiLiBCYXJydSIsIkthYi4gUGFuZ2thamVuZSBLZXB1bGF1YW4iLCJLYWIuIE1hcm9zIiwiS2FiLiBCb25lIiwiS2FiLiBTaW5qYWkiLCJLYWIuIEdvd2EiLCJLYWIuIFRha2FsYXIiLCJLYWIuIEplbmVwb250byIsIkthYi4gQmFudGFlbmciLCJLYWIuIEJ1bHVrdW1iYSIsIkthYi4gS2VwdWxhdWFuIFNlbGF5YXIiXX0seyJwcm92aW5zaSI6IlN1bGF3ZXNpIFRlbmdnYXJhIiwia290YSI6WyJLb3RhIEtlbmRhcmkiLCJLb3RhIEJhdSBCYXUiLCJLYWIuIEJ1dG9uIFNlbGF0YW4iLCJLYWIuIEJ1dG9uIFRlbmdhaCIsIkthYi4gTXVuYSBCYXJhdCIsIkthYi4gS29uYXdlIEtlcHVsYXVhbiIsIkthYi4gS29sYWthIFRpbXVyIiwiS2FiLiBCdXRvbiBVdGFyYSIsIkthYi4gS29uYXdlIFV0YXJhIiwiS2FiLiBLb2xha2EgVXRhcmEiLCJLYWIuIFdha2F0b2JpIiwiS2FiLiBCb21iYW5hIiwiS2FiLiBLb25hd2UgU2VsYXRhbiIsIkthYi4gQnV0b24iLCJLYWIuIE11bmEiLCJLYWIuIEtvbmF3ZSIsIkthYi4gS29sYWthIl19LHsicHJvdmluc2kiOiJHb3JvbnRhbG8iLCJrb3RhIjpbIktvdGEgR29yb250YWxvIiwiS2FiLiBQb2h1d2F0byIsIkthYi4gQm9uZSBCb2xhbmdvIiwiS2FiLiBCb2FsZW1vIiwiS2FiLiBHb3JvbnRhbG8iLCJLYWIuIEdvcm9udGFsbyBVdGFyYSJdfSx7InByb3ZpbnNpIjoiU3VsYXdlc2kgQmFyYXQiLCJrb3RhIjpbIkthYi4gTWFqZW5lIiwiS2FiLiBQb2xvd2FsaSBNYW5kYXIiLCJLYWIuIE1hbWFzYSIsIkthYi4gTWFtdWp1IiwiS2FiLiBNYW11anUgVXRhcmEiLCJLYWIuIE1hbXVqdSBUZW5nYWgiXX0seyJwcm92aW5zaSI6Ik1hbHVrdSIsImtvdGEiOlsiS290YSBBbWJvbiIsIktvdGEgVHVhbCIsIkthYi4gQnVydSBTZWxhdGFuIiwiS2FiLiBNYWx1a3UgQmFyYXQgRGF5YSIsIkthYi4gS2VwdWxhdWFuIEFydSIsIkthYi4gU2VyYW0gQmFnaWFuIEJhcmF0ICIsIkthYi4gU2VyYW0gQmFnaWFuIFRpbXVyIiwiS2FiLiBCdXJ1IiwiS2FiLiBNYWx1a3UgVGVuZ2dhcmEgQmFyYXQiLCJLYWIuIE1hbHVrdSBUZW5nZ2FyYSIsIkthYi4gTWFsdWt1IFRlbmdhaCJdfSx7InByb3ZpbnNpIjoiTWFsdWt1IFV0YXJhIiwia290YSI6WyJLb3RhIFRlcm5hdGUiLCJLb3RhIFRpZG9yZSBLZXB1bGF1YW4iLCJLYWIuIFB1bGF1IFRhbGlhYnUiLCJLYWIuIFB1bGF1IE1vcm90YWkiLCJLYWIuIEhhbG1haGVyYSBUaW11ciIsIkthYi4gS2VwdWxhdWFuIFN1bGEiLCJLYWIuIEhhbG1haGVyYSBTZWxhdGFuIiwiS2FiLiBIYWxtYWhlcmEgVXRhcmEiLCJLYWIuIEhhbG1haGVyYSBUZW5nYWgiLCJLYWIuIEhhbG1haGVyYSBCYXJhdCJdfSx7InByb3ZpbnNpIjoiUGFwdWEiLCJrb3RhIjpbIktvdGEgSmF5YXB1cmEiLCJLYWIuIERlaXlhaSIsIkthYi4gSW50YW4gSmF5YSIsIkthYi4gRG9naXlhaSIsIkthYi4gUHVuY2FrIiwiS2FiLiBOZHVnYSIsIkthYi4gTGFubnkgSmF5YSIsIkthYi4gWWFsaW1vIiwiS2FiLiBNYW1iZXJhbW8gVGVuZ2FoIiwiS2FiLiBNYW1iZXJhbW8gUmF5YSIsIkthYi4gU3VwaW9yaSIsIkthYi4gQXNtYXQiLCJLYWIuIE1hcHBpIiwiS2FiLiBCb3ZlbiBEaWdvZWwiLCJLYWIuIFdhcm9wZW4iLCJLYWIuIFRvbGlrYXJhIiwiS2FiLiBZYWh1a2ltbyIsIkthYi4gUGVndW51bmdhbiBCaW50YW5nIiwiS2FiLiBLZWVyb20iLCJLYWIuIFNhcm1pIiwiS2FiLiBNaW1pa2EiLCJLYWIuIFBhbmlhaSIsIkthYi4gUHVuY2FrIEpheWEiLCJLYWIuIEJpYWsgTnVtZm9yIiwiS2FiLiBLZXB1bGF1YW4gWWFwZW4iLCJLYWIuIE5hYmlyZSIsIkthYi4gSmF5YXB1cmEiLCJLYWIuIEpheWF3aWpheWEiLCJLYWIuIE1lcmF1a2UiXX0seyJwcm92aW5zaSI6IlBhcHVhIEJhcmF0Iiwia290YSI6WyJLb3RhIFNvcm9uZyIsIkthYi4gUGVndW51bmdhbiBBcmZhayIsIkthYi4gTWFub2t3YXJpIFNlbGF0YW4iLCJLYWIuIE1heWJyYXQiLCJLYWIuIFRhbWJyYXV3IiwiS2FiLiBLYWltYW5hIiwiS2FiLiBUZWx1ayBXb25kYW1hIiwiS2FiLiBUZWx1ayBCaW50dW5pIiwiS2FiLiBSYWphIEFtcGF0IiwiS2FiLiBTb3JvbmcgU2VsYXRhbiIsIkthYi4gRmFrIEZhayIsIkthYi4gTWFub2t3YXJpIiwiS2FiLiBTb3JvbmciXX1d'";
    public function index()
    {
        $province = json_decode(base64_decode($this->province));

        $user = null;

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level != 'user') {
                return redirect('/');
            }
            if ($user->is_fundraiser == 1) {
                return redirect('/fundraiser');
            }
        }

        return view('front.fundraiser.index')->with([
            'provinces' => $province,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $user = null;

        $rules = [
            'type' => 'required|in:personal,instance',
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'province' => 'required',
            'city' => 'required',
        ];
        
        $rules['password'] = 'required|min:8:confirmed';

        if (Auth::check()) {
            $rules['password'] = 'nullable';

            $user = Auth::user();
            if ($user->level != 'user') {
                return redirect('/');
            }
            if ($user->is_fundraiser == 1) {
                return redirect('/fundraiser');
            }
        }

        $request->validate($rules);

        if (!$user) {
            $request->validate([
                'email' => 'required|unique:users',
            ]);
            $user = User::create([
                'name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
            ]);
        }
        Fundraiser::create([
            'user_id' => $user->id,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'person_in_charge' => $request->person_in_charge,
            'province' => $request->province,
            'city' => $request->city,
            'referral_code' => $this->generateReferralCode(),
        ]);
        $user->update([
            'is_fundraiser' => 1,
        ]);

        // $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/fundraiser');
        }

        return redirect('/');
    }

    public function all($id)
    {
        $project = Project::findOrFail($id);
        $fundraisers = $project->getFundraisers();

        foreach ($fundraisers as $k => $v) {
            $v->photo = $this->usernamify($v->name);
        }

        return view('front.fundraiser.all')->with([
            'datas' => $fundraisers,
            'project' => $project,
        ]);
    }

    private function generateReferralCode()
    {
        $generated = Str::random(7);
        $check = Fundraiser::where('referral_code', $generated)
            ->first();
        if ($check) {
            return $this->generateReferralCode();
        }

        return $generated;
    }
}
