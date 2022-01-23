<?php
/**
 * PhpOffice for FuelPHP
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    PhpOffice
 * @version    1.0
 * @author     Emmanuel MBULU
 * @copyright  2020 E-COM SAS
 * @link       https://e-comsas.com
 */

\Autoloader::add_namespace('PhpOffice', __DIR__.'/classes/');

\Autoloader::add_classes(array(
    /** RACINE DU DOSSIER */
    'PhpOffice\\PhpWord\\IOFactory'        =>	__DIR__.'/classes/PhpWord/IOFactory.php',
    'PhpOffice\\PhpWord\\Media'        =>	__DIR__.'/classes/PhpWord/Media.php',
    'PhpOffice\\PhpWord\\PhpWord'        =>	__DIR__.'/classes/PhpWord/PhpWord.php',
    'PhpOffice\\PhpWord\\Settings'        =>	__DIR__.'/classes/PhpWord/Settings.php',
    'PhpOffice\\PhpWord\\Style'        =>	__DIR__.'/classes/PhpWord/Style.php',
    'PhpOffice\\PhpWord\\Template'        =>	__DIR__.'/classes/PhpWord/Template.php',
    'PhpOffice\\PhpWord\\TemplateProcessor'        =>	__DIR__.'/classes/PhpWord/TemplateProcessor.php',
    
    /** SOUS-DOSSIER COLLECTION */
    'PhpOffice\\PhpWord\\Collection\\AbstractCollection'        =>	__DIR__.'/classes/PhpWord/Collection/AbstractCollection.php',
    'PhpOffice\\PhpWord\\Collection\\Bookmarks'        =>	__DIR__.'/classes/PhpWord/Collection/Bookmarks.php',
    'PhpOffice\\PhpWord\\Collection\\Charts'        =>	__DIR__.'/classes/PhpWord/Collection/Charts.php',
    'PhpOffice\\PhpWord\\Collection\\Comments'        =>	__DIR__.'/classes/PhpWord/Collection/Comments.php',
    'PhpOffice\\PhpWord\\Collection\\Endnotes'        =>	__DIR__.'/classes/PhpWord/Collection/Endnotes.php',
    'PhpOffice\\PhpWord\\Collection\\Footnotes'        =>	__DIR__.'/classes/PhpWord/Collection/Footnotes.php',
    'PhpOffice\\PhpWord\\Collection\\Titles'        =>	__DIR__.'/classes/PhpWord/Collection/Titles.php',

    /** SOUS-DOSSIER COMPLEXTYPE */
    'PhpOffice\\PhpWord\\ComplexType\\FootnoteProperties'        =>	__DIR__.'/classes/PhpWord/ComplexType/FootnoteProperties.php',
    'PhpOffice\\PhpWord\\ComplexType\\ProofState'        =>	__DIR__.'/classes/PhpWord/ComplexType/ProofState.php',
    'PhpOffice\\PhpWord\\ComplexType\\TblWidth'        =>	__DIR__.'/classes/PhpWord/ComplexType/TblWidth.php',
    'PhpOffice\\PhpWord\\ComplexType\\TrackChangesView'        =>	__DIR__.'/classes/PhpWord/ComplexType/TrackChangesView.php',

    /** SOUS-DOSSIER ELEMENT */
    'PhpOffice\\PhpWord\\Element\\AbstractContainer'        =>	__DIR__.'/classes/PhpWord/Element/AbstractContainer.php',
    'PhpOffice\\PhpWord\\Element\\AbstractElement'        =>	__DIR__.'/classes/PhpWord/Element/AbstractElement.php',
    'PhpOffice\\PhpWord\\Element\\Bookmark'        =>	__DIR__.'/classes/PhpWord/Element/Bookmark.php',
    'PhpOffice\\PhpWord\\Element\\Cell'        =>	__DIR__.'/classes/PhpWord/Element/Cell.php',
    'PhpOffice\\PhpWord\\Element\\Chart'        =>	__DIR__.'/classes/PhpWord/Element/Chart.php',
    'PhpOffice\\PhpWord\\Element\\CheckBox'        =>	__DIR__.'/classes/PhpWord/Element/CheckBox.php',
    'PhpOffice\\PhpWord\\Element\\Comment'        =>	__DIR__.'/classes/PhpWord/Element/Comment.php',
    'PhpOffice\\PhpWord\\Element\\Endnote'        =>	__DIR__.'/classes/PhpWord/Element/Endnote.php',
    'PhpOffice\\PhpWord\\Element\\Field'        =>	__DIR__.'/classes/PhpWord/Element/Field.php',
    'PhpOffice\\PhpWord\\Element\\Footer'        =>	__DIR__.'/classes/PhpWord/Element/Footer.php',
    'PhpOffice\\PhpWord\\Element\\Footnote'        =>	__DIR__.'/classes/PhpWord/Element/Footnote.php',
    'PhpOffice\\PhpWord\\Element\\FormField'        =>	__DIR__.'/classes/PhpWord/Element/FormField.php',
    'PhpOffice\\PhpWord\\Element\\Header'        =>	__DIR__.'/classes/PhpWord/Element/Header.php',
    'PhpOffice\\PhpWord\\Element\\Image'        =>	__DIR__.'/classes/PhpWord/Element/Image.php',
    'PhpOffice\\PhpWord\\Element\\Line'        =>	__DIR__.'/classes/PhpWord/Element/Line.php',
    'PhpOffice\\PhpWord\\Element\\Link'        =>	__DIR__.'/classes/PhpWord/Element/Link.php',
    'PhpOffice\\PhpWord\\Element\\ListItem'        =>	__DIR__.'/classes/PhpWord/Element/ListItem.php',
    'PhpOffice\\PhpWord\\Element\\ListItemRun'        =>	__DIR__.'/classes/PhpWord/Element/ListItemRun.php',
    'PhpOffice\\PhpWord\\Element\\OLEObject'        =>	__DIR__.'/classes/PhpWord/Element/OLEObject.php',
    'PhpOffice\\PhpWord\\Element\\PageBreak'        =>	__DIR__.'/classes/PhpWord/Element/PageBreak.php',
    'PhpOffice\\PhpWord\\Element\\PreserveText'        =>	__DIR__.'/classes/PhpWord/Element/PreserveText.php',
    'PhpOffice\\PhpWord\\Element\\Row'        =>	__DIR__.'/classes/PhpWord/Element/Row.php',
    'PhpOffice\\PhpWord\\Element\\SDT'        =>	__DIR__.'/classes/PhpWord/Element/SDT.php',
    'PhpOffice\\PhpWord\\Element\\Section'        =>	__DIR__.'/classes/PhpWord/Element/Section.php',
    'PhpOffice\\PhpWord\\Element\\Shape'        =>	__DIR__.'/classes/PhpWord/Element/Shape.php',
    'PhpOffice\\PhpWord\\Element\\Table'        =>	__DIR__.'/classes/PhpWord/Element/Table.php',
    'PhpOffice\\PhpWord\\Element\\Text'        =>	__DIR__.'/classes/PhpWord/Element/Text.php',
    'PhpOffice\\PhpWord\\Element\\TextBox'        =>	__DIR__.'/classes/PhpWord/Element/TextBox.php',
    'PhpOffice\\PhpWord\\Element\\TextBreak'        =>	__DIR__.'/classes/PhpWord/Element/TextBreak.php',
    'PhpOffice\\PhpWord\\Element\\TextRun'        =>	__DIR__.'/classes/PhpWord/Element/TextRun.php',
    'PhpOffice\\PhpWord\\Element\\Title'        =>	__DIR__.'/classes/PhpWord/Element/Title.php',
    'PhpOffice\\PhpWord\\Element\\TOC'        =>	__DIR__.'/classes/PhpWord/Element/TOC.php',
    'PhpOffice\\PhpWord\\Element\\TrackChange'        =>	__DIR__.'/classes/PhpWord/Element/TrackChange.php',

    /** SOUS-DOSSIER ESCAPER */
    'PhpOffice\\PhpWord\\Escaper\\AbstractEscaper'        =>	__DIR__.'/classes/PhpWord/Escaper/AbstractEscaper.php',
    'PhpOffice\\PhpWord\\Escaper\\EscaperInterface'        =>	__DIR__.'/classes/PhpWord/Escaper/EscaperInterface.php',
    'PhpOffice\\PhpWord\\Escaper\\RegExp'        =>	__DIR__.'/classes/PhpWord/Escaper/RegExp.php',
    'PhpOffice\\PhpWord\\Escaper\\Rtf'        =>	__DIR__.'/classes/PhpWord/Escaper/Rtf.php',
    'PhpOffice\\PhpWord\\Escaper\\Xml'        =>	__DIR__.'/classes/PhpWord/Escaper/Xml.php',

    /** SOUS-DOSSIER EXCEPTION */
    'PhpOffice\\PhpWord\\Exception\\CopyFileException'        =>	__DIR__.'/classes/PhpWord/Exception/CopyFileException.php',
    'PhpOffice\\PhpWord\\Exception\\CreateTemporaryFileException'        =>	__DIR__.'/classes/PhpWord/Exception/CreateTemporaryFileException.php',
    'PhpOffice\\PhpWord\\Exception\\Exception'        =>	__DIR__.'/classes/PhpWord/Exception/Exception.php',
    'PhpOffice\\PhpWord\\Exception\\InvalidImageException'        =>	__DIR__.'/classes/PhpWord/Exception/InvalidImageException.php',
    'PhpOffice\\PhpWord\\Exception\\InvalidObjectException'        =>	__DIR__.'/classes/PhpWord/Exception/InvalidObjectException.php',
    'PhpOffice\\PhpWord\\Exception\\InvalidStyleException'        =>	__DIR__.'/classes/PhpWord/Exception/InvalidStyleException.php',
    'PhpOffice\\PhpWord\\Exception\\UnsupportedImageTypeException'        =>	__DIR__.'/classes/PhpWord/Exception/UnsupportedImageTypeException.php',

    /** SOUS-DOSSIER METADATA */
    'PhpOffice\\PhpWord\\Metadata\\Compatibility'        =>	__DIR__.'/classes/PhpWord/Metadata/Compatibility.php',
    'PhpOffice\\PhpWord\\Metadata\\DocInfo'        =>	__DIR__.'/classes/PhpWord/Metadata/DocInfo.php',
    'PhpOffice\\PhpWord\\Metadata\\Protection'        =>	__DIR__.'/classes/PhpWord/Metadata/Protection.php',
    'PhpOffice\\PhpWord\\Metadata\\Settings'        =>	__DIR__.'/classes/PhpWord/Metadata/Settings.php',

    /** SOUS DOSSIER READER */
    'PhpOffice\\PhpWord\\Reader\\AbstractReader'        =>	__DIR__.'/classes/PhpWord/Reader/AbstractReader.php',
    'PhpOffice\\PhpWord\\Reader\\HTML'        =>	__DIR__.'/classes/PhpWord/Reader/HTML.php',
    'PhpOffice\\PhpWord\\Reader\\MsDoc'        =>	__DIR__.'/classes/PhpWord/Reader/MsDoc.php',
    'PhpOffice\\PhpWord\\Reader\\ODText'        =>	__DIR__.'/classes/PhpWord/Reader/ODText.php',
    'PhpOffice\\PhpWord\\Reader\\ReaderInterface'        =>	__DIR__.'/classes/PhpWord/Reader/ReaderInterface.php',
    'PhpOffice\\PhpWord\\Reader\\RTF'        =>	__DIR__.'/classes/PhpWord/Reader/RTF.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007.php',

    /** SOUS-DOSSIER READER > ODText */
    'PhpOffice\\PhpWord\\Reader\\ODText\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Reader/ODText/AbstractPart.php',
    'PhpOffice\\PhpWord\\Reader\\ODText\\Content'        =>	__DIR__.'/classes/PhpWord/Reader/ODText/Content.php',
    'PhpOffice\\PhpWord\\Reader\\ODText\\Meta'        =>	__DIR__.'/classes/PhpWord/Reader/ODText/Meta.php',

    /** SOUS-DOSSIER READER > Document */
    'PhpOffice\\PhpWord\\Reader\\RTF\\Document'        =>	__DIR__.'/classes/PhpWord/Reader/RTF/Document.php',

    /** SOUS-DOSSIER READER > Word2007 */
    'PhpOffice\\PhpWord\\Reader\\Word2007\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/AbstractPart.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\DocPropsApp'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/DocPropsApp.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\DocPropsCore'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/DocPropsCore.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\DocPropsCustom'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/DocPropsCustom.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Document'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Document.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Endnotes'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Endnotes.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Footnotes'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Footnotes.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Numbering'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Numbering.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Settings'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Settings.php',
    'PhpOffice\\PhpWord\\Reader\\Word2007\\Styles'        =>	__DIR__.'/classes/PhpWord/Reader/Word2007/Styles.php',

    /** SOUS-DOSSIER SHARED */
    'PhpOffice\\PhpWord\\Shared\\AbstractEnum'        =>	__DIR__.'/classes/PhpWord/Shared/AbstractEnum.php',
    'PhpOffice\\PhpWord\\Shared\\Converter'        =>	__DIR__.'/classes/PhpWord/Shared/Converter.php',
    'PhpOffice\\PhpWord\\Shared\\Drawing'        =>	__DIR__.'/classes/PhpWord/Shared/Drawing.php',
    'PhpOffice\\PhpWord\\Shared\\Html'        =>	__DIR__.'/classes/PhpWord/Shared/Html.php',
    'PhpOffice\\PhpWord\\Shared\\OLERead'        =>	__DIR__.'/classes/PhpWord/Shared/OLERead.php',
    'PhpOffice\\PhpWord\\Shared\\Text'        =>	__DIR__.'/classes/PhpWord/Shared/Text.php',
    'PhpOffice\\PhpWord\\Shared\\XMLReader'        =>	__DIR__.'/classes/PhpWord/Shared/XMLReader.php',
    'PhpOffice\\PhpWord\\Shared\\XMLWriter'        =>	__DIR__.'/classes/PhpWord/Shared/XMLWriter.php',
    'PhpOffice\\PhpWord\\Shared\\ZipArchive'        =>	__DIR__.'/classes/PhpWord/Shared/ZipArchive.php',
    
    /** SOUS-DOSSIER SHARED > MICROSOFT */
    'PhpOffice\\PhpWord\\Shared\\Microsoft\\PasswordEncoder'        =>	__DIR__.'/classes/PhpWord/Shared/Microsoft/PasswordEncoder.php',

    /** SOUS-DOSSIER SHARED > PCLZIP */
    'PhpOffice\\PhpWord\\Shared\\PCLZip\\PclZip'        =>	__DIR__.'/classes/PhpWord/Shared/PCLZip/pclzip.lib.php',

    /** SOUS-DOSSIER SIMPLETYPE */
    'PhpOffice\\PhpWord\\SimpleType\\Border'        =>	__DIR__.'/classes/PhpWord/SimpleType/Border.php',
    'PhpOffice\\PhpWord\\SimpleType\\DocProtect'        =>	__DIR__.'/classes/PhpWord/SimpleType/DocProtect.php',
    'PhpOffice\\PhpWord\\SimpleType\\Jc'        =>	__DIR__.'/classes/PhpWord/SimpleType/Jc.php',
    'PhpOffice\\PhpWord\\SimpleType\\JcTable'        =>	__DIR__.'/classes/PhpWord/SimpleType/JcTable.php',
    'PhpOffice\\PhpWord\\SimpleType\\LineSpacingRule'        =>	__DIR__.'/classes/PhpWord/SimpleType/LineSpacingRule.php',
    'PhpOffice\\PhpWord\\SimpleType\\NumberFormat'        =>	__DIR__.'/classes/PhpWord/SimpleType/NumberFormat.php',
    'PhpOffice\\PhpWord\\SimpleType\\TblWidth'        =>	__DIR__.'/classes/PhpWord/SimpleType/TblWidth.php',
    'PhpOffice\\PhpWord\\SimpleType\\TextAlignment'        =>	__DIR__.'/classes/PhpWord/SimpleType/TextAlignment.php',
    'PhpOffice\\PhpWord\\SimpleType\\VerticalJc'        =>	__DIR__.'/classes/PhpWord/SimpleType/VerticalJc.php',
    'PhpOffice\\PhpWord\\SimpleType\\Zoom'        =>	__DIR__.'/classes/PhpWord/SimpleType/Zoom.php',

    /** SOUS-DOSSIER SIMPLETYPE */
    'PhpOffice\\PhpWord\\Style\\AbstractStyle'        =>	__DIR__.'/classes/PhpWord/Style/AbstractStyle.php',
    'PhpOffice\\PhpWord\\Style\\Border'        =>	__DIR__.'/classes/PhpWord/Style/Border.php',
    'PhpOffice\\PhpWord\\Style\\Cell'        =>	__DIR__.'/classes/PhpWord/Style/Cell.php',
    'PhpOffice\\PhpWord\\Style\\Chart'        =>	__DIR__.'/classes/PhpWord/Style/Chart.php',
    'PhpOffice\\PhpWord\\Style\\Extrusion'        =>	__DIR__.'/classes/PhpWord/Style/Extrusion.php',
    'PhpOffice\\PhpWord\\Style\\Fill'        =>	__DIR__.'/classes/PhpWord/Style/Fill.php',
    'PhpOffice\\PhpWord\\Style\\Font'        =>	__DIR__.'/classes/PhpWord/Style/Font.php',
    'PhpOffice\\PhpWord\\Style\\Frame'        =>	__DIR__.'/classes/PhpWord/Style/Frame.php',
    'PhpOffice\\PhpWord\\Style\\Image'        =>	__DIR__.'/classes/PhpWord/Style/Image.php',
    'PhpOffice\\PhpWord\\Style\\Indentation'        =>	__DIR__.'/classes/PhpWord/Style/Indentation.php',
    'PhpOffice\\PhpWord\\Style\\Language'        =>	__DIR__.'/classes/PhpWord/Style/Language.php',
    'PhpOffice\\PhpWord\\Style\\Line'        =>	__DIR__.'/classes/PhpWord/Style/Line.php',
    'PhpOffice\\PhpWord\\Style\\LineNumbering'        =>	__DIR__.'/classes/PhpWord/Style/LineNumbering.php',
    'PhpOffice\\PhpWord\\Style\\ListItem'        =>	__DIR__.'/classes/PhpWord/Style/ListItem.php',
    'PhpOffice\\PhpWord\\Style\\Numbering'        =>	__DIR__.'/classes/PhpWord/Style/Numbering.php',
    'PhpOffice\\PhpWord\\Style\\NumberingLevel'        =>	__DIR__.'/classes/PhpWord/Style/NumberingLevel.php',
    'PhpOffice\\PhpWord\\Style\\Outline'        =>	__DIR__.'/classes/PhpWord/Style/Outline.php',
    'PhpOffice\\PhpWord\\Style\\Paper'        =>	__DIR__.'/classes/PhpWord/Style/Paper.php',
    'PhpOffice\\PhpWord\\Style\\Paragraph'        =>	__DIR__.'/classes/PhpWord/Style/Paragraph.php',
    'PhpOffice\\PhpWord\\Style\\Row'        =>	__DIR__.'/classes/PhpWord/Style/Row.php',
    'PhpOffice\\PhpWord\\Style\\Section'        =>	__DIR__.'/classes/PhpWord/Style/Section.php',
    'PhpOffice\\PhpWord\\Style\\Shading'        =>	__DIR__.'/classes/PhpWord/Style/Shading.php',
    'PhpOffice\\PhpWord\\Style\\Shadow'        =>	__DIR__.'/classes/PhpWord/Style/Shadow.php',
    'PhpOffice\\PhpWord\\Style\\Shape'        =>	__DIR__.'/classes/PhpWord/Style/Shape.php',
    'PhpOffice\\PhpWord\\Style\\Spacing'        =>	__DIR__.'/classes/PhpWord/Style/Spacing.php',
    'PhpOffice\\PhpWord\\Style\\Tab'        =>	__DIR__.'/classes/PhpWord/Style/Tab.php',
    'PhpOffice\\PhpWord\\Style\\Table'        =>	__DIR__.'/classes/PhpWord/Style/Table.php',
    'PhpOffice\\PhpWord\\Style\\TablePosition'        =>	__DIR__.'/classes/PhpWord/Style/TablePosition.php',
    'PhpOffice\\PhpWord\\Style\\TextBox'        =>	__DIR__.'/classes/PhpWord/Style/TextBox.php',
    'PhpOffice\\PhpWord\\Style\\TOC'        =>	__DIR__.'/classes/PhpWord/Style/TOC.php',

    /** SOUS-DOSSIER WRITER */
    'PhpOffice\\PhpWord\\Writer\\AbstractWriter'        =>	__DIR__.'/classes/PhpWord/Writer/AbstractWriter.php',    
    'PhpOffice\\PhpWord\\Writer\\HTML'        =>	__DIR__.'/classes/PhpWord/Writer/HTML.php',
    'PhpOffice\\PhpWord\\Writer\\ODText'        =>	__DIR__.'/classes/PhpWord/Writer/ODText.php',
    'PhpOffice\\PhpWord\\Writer\\PDF'        =>	__DIR__.'/classes/PhpWord/Writer/PDF.php',
    'PhpOffice\\PhpWord\\Writer\\RTF'        =>	__DIR__.'/classes/PhpWord/Writer/RTF.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007.php',
    'PhpOffice\\PhpWord\\Writer\\WriterInterface'        =>	__DIR__.'/classes/PhpWord/Writer/WriterInterface.php',

    /** SOUS-DOSSIER WRITER > HTML > ELEMENT */
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\AbstractElement'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/AbstractElement.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Bookmark'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Bookmark.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Container'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Container.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Endnote'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Endnote.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Footnote'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Footnote.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Image.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Link'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Link.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\ListItem'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/ListItem.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\ListItemRun'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/ListItemRun.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\PageBreak'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/PageBreak.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Table.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Text'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Text.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\TextBreak'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/TextBreak.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\TextRun'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/TextRun.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Element\\Title'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Element/Title.php',

    /** SOUS-DOSSIER WRITER > HTML > PART */
    'PhpOffice\\PhpWord\\Writer\\HTML\\Part\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Part/AbstractPart.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Part\\Body'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Part/Body.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Part\\Head'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Part/Head.php',

    /** SOUS-DOSSIER WRITER > HTML > STYLE */
    'PhpOffice\\PhpWord\\Writer\\HTML\\Style\\AbstractStyle'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Style/AbstractStyle.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Style\\Font'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Style/Font.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Style\\Generic'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Style/Generic.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Style\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Style/Image.php',
    'PhpOffice\\PhpWord\\Writer\\HTML\\Style\\Paragraph'        =>	__DIR__.'/classes/PhpWord/Writer/HTML/Style/Paragraph.php',

    /** SOUS-DOSSIER WRITER > ODTEXT > ELEMENT */
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\AbstractElement'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/AbstractElement.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Container'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Container.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Field'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Field.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Image.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Link'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Link.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\PageBreak'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/PageBreak.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Table.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Text'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Text.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\TextBreak'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/TextBreak.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\TextRun'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/TextRun.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Element\\Title'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Element/Title.php',

    /** SOUS-DOSSIER WRITER > ODTEXT > PART */
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/AbstractPart.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\Content'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/Content.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\Manifest'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/Manifest.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\Meta'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/Meta.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\Mimetype'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/Mimetype.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Part\\Styles'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Part/Styles.php',

    /** SOUS-DOSSIER WRITER > ODTEXT > STYLE */
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\AbstractStyle'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/AbstractStyle.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\Font'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/Font.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/Image.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\Paragraph'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/Paragraph.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\Section'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/Section.php',
    'PhpOffice\\PhpWord\\Writer\\ODText\\Style\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/ODText/Style/Table.php',

    /** SOUS-DOSSIER WRITER > PDF */
    'PhpOffice\\PhpWord\\Writer\\PDF\\AbstractRenderer'        =>	__DIR__.'/classes/PhpWord/Writer/PDF/AbstractRenderer.php',
    'PhpOffice\\PhpWord\\Writer\\PDF\\DomPDF'        =>	__DIR__.'/classes/PhpWord/Writer/PDF/DomPDF.php',
    'PhpOffice\\PhpWord\\Writer\\PDF\\MPDF'        =>	__DIR__.'/classes/PhpWord/Writer/PDF/MPDF.php',
    'PhpOffice\\PhpWord\\Writer\\PDF\\TCPDF'        =>	__DIR__.'/classes/PhpWord/Writer/PDF/TCPDF.php',

    /** SOUS-DOSSIER WRITER > RTF > ELEMENT */
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\AbstractElement'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/AbstractElement.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Container'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Container.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Field'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Field.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Image.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Link'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Link.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\ListItem'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/ListItem.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\PageBreak'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/PageBreak.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Table.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Text'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Text.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\TextBreak'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/TextBreak.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\TextRun'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/TextRun.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Element\\Title'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Element/Title.php',

    /** SOUS-DOSSIER WRITER > RTF > PART */
    'PhpOffice\\PhpWord\\Writer\\RTF\\Part\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Part/AbstractPart.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Part\\Document'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Part/Document.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Part\\Header'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Part/Header.php',

    /** SOUS-DOSSIER WRITER > RTF > STYLE */
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\AbstractStyle'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/AbstractStyle.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Border'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Border.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Font'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Font.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Indentation'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Indentation.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Paragraph'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Paragraph.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Section'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Section.php',
    'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\Tab'        =>	__DIR__.'/classes/PhpWord/Writer/RTF/Style/Tab.php',

    /** SOUS-DOSSIER WRITER > WORD2007 > ELEMENT */
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\AbstractElement'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/AbstractElement.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Bookmark'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Bookmark.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Chart'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Chart.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\CheckBox'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/CheckBox.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Container'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Container.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Endnote'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Endnote.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Field'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Field.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Footnote'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Footnote.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\FormField'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/FormField.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Image.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Line'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Line.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Link'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Link.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\ListItem'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/ListItem.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\ListItemRun'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/ListItemRun.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\OLEObject'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/OLEObject.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\PageBreak'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/PageBreak.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\ParagraphAlignment'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/ParagraphAlignment.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\PreserveText'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/PreserveText.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\SDT'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/SDT.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Shape'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Shape.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Table.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\TableAlignment'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/TableAlignment.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Text'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Text.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\TextBox'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/TextBox.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\TextBreak'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/TextBreak.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\TextRun'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/TextRun.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\Title'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/Title.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Element\\TOC'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Element/TOC.php',

    /** SOUS-DOSSIER WRITER > WORD2007 > PART */
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\AbstractPart'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/AbstractPart.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Chart'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Chart.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Comments'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Comments.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\ContentTypes'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/ContentTypes.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\DocPropsApp'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/DocPropsApp.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\DocPropsCore'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/DocPropsCore.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\DocPropsCustom'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/DocPropsCustom.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Document'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Document.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Endnotes'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Endnotes.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\FontTable'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/FontTable.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Footer'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Footer.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Footnotes'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Footnotes.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Header'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Header.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Numbering'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Numbering.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Rels'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Rels.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\RelsDocument'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/RelsDocument.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\RelsPart'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/RelsPart.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Settings'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Settings.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Styles'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Styles.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\Theme'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/Theme.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Part\\WebSettings'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Part/WebSettings.php',

    /** SOUS-DOSSIER WRITER > WORD2007 > STYLE */
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\AbstractStyle'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/AbstractStyle.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Cell'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Cell.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Extrusion'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Extrusion.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Fill'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Fill.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Font'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Font.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Frame'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Frame.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Image'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Image.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Indentation'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Indentation.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Line'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Line.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\LineNumbering'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/LineNumbering.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\MarginBorder'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/MarginBorder.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Outline'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Outline.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Paragraph'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Paragraph.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Row'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Row.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Section'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Section.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Shading'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Shading.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Shadow'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Shadow.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Shape'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Shape.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Spacing'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Spacing.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Tab'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Tab.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\Table'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/Table.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\TablePosition'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/TablePosition.php',
    'PhpOffice\\PhpWord\\Writer\\Word2007\\Style\\TextBox'        =>	__DIR__.'/classes/PhpWord/Writer/Word2007/Style/TextBox.php',
));