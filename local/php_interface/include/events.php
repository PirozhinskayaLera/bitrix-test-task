<?
//Регистрируем обработчики событий
AddEventHandler("main", "OnBeforeUserUpdate", Array("MyHandlers", "OnBeforeUserAddAndUpdate"));
AddEventHandler("main", "OnBeforeUserAdd", Array("MyHandlers", "OnBeforeUserAddAndUpdate"));
AddEventHandler("main", "OnAfterUserAdd", Array("MyHandlers", "sendEventContentManager"));
AddEventHandler("main", "OnAfterUserUpdate", Array("MyHandlers", "sendEventContentManager"));
 
class MyHandlers
{
    public static function OnBeforeUserAddAndUpdate(&$arFields)
    { 
        $baseGroups = [];
        if ($arFields['ID']) {
            $baseGroups = CUser::GetUserGroup($arFields['ID']); 
        }
        $arFields['BASE_GROUPS'] = $baseGroups;
    }

    public static function sendEventContentManager(&$arFields)
    {
        if ($arFields['RESULT'] == true && 
            !in_array(GROUP_CONTENT_ID, $arFields['BASE_GROUPS']) && 
            in_array(GROUP_CONTENT_ID, array_column($arFields['GROUP_ID'], 'GROUP_ID'))
         ) {
            
            $rsUsers = CUser::GetList(($by="id"), ($order="desc"), ['!ID' => $arFields['ID'], "GROUPS_ID" => array(GROUP_CONTENT_ID)]);
             $arEmail = [];
             while($arResUser = $rsUsers->GetNext())
             {
                $arEmail[] = $arResUser["EMAIL"];
             }

             if(count($arEmail) > 0)
             {
                $arEventFields = array(
                      "USER_INFO" => $arFields['LAST_NAME'] . ' ' . $arFields['NAME'] . '[' . $arFields['ID'] . ']',
                      "GROUP_ID" => GROUP_CONTENT_ID,
                      "EMAIL_USERS_GROUP" => implode(", ", $arEmail),
                );
                CEvent::Send("USER_NEW_GROUP", "s1", $arEventFields);
             }  
        }
    }
}
